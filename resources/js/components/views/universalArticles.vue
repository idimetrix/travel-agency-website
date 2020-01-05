<template>
    <div class="justify-content-center">
        <v-card-title class="cart-title-modify">
            <h3>
                {{clarify_type === 'country' ? 'Страны' : 'Направления'}}
            </h3>
        </v-card-title>
        <div class="card-container">
            <v-btn color="#7460ee" class="add-button" round @click="emitAdding">Добавить</v-btn>
            <v-data-table class="table-custom"
                          :headers="articlesHeaders"
                          hide-actions
                          :items="articles"
                          :loading="active">
                <v-progress-linear slot="progress" color="info" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="props">
                    <tr style="cursor: pointer" @click="getSelectedArticle(props.item.id)" v-if="!active">
                        <td class="text-xs-center">{{(props.index+1) + (page-1) * per_page}}</td>
                        <td class="text-xs-center">
                            <div class="image-container-for-table" v-if="props.item.main_image">
                                <v-avatar v-if="props.item.main_image.url"
                                          :size="130"
                                          color="grey lighten-4"
                                          class="mt-2 mb-2">
                                    <img :src="props.item.main_image.url" alt=""/>
                                </v-avatar>
                            </div>
                        </td>
                        <td class="text-xs-left">{{props.item.title}}</td>
                        <td class="text-xs-left">{{props.item.short_description}}</td>
                        <td class="text-xs-left">{{props.item.description |limiter(400) }}</td>
                        <td class="text-xs-center">
                            <v-btn color="red" fab small dark @click.stop="callModalDelete(props.item.id, props.index)">
                                —
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <div class="text-xs-center" v-if="last_page && articles.length" v-show="!active">
                <v-pagination color="#4db6ac!important"
                              v-model="page"
                              :length="last_page"
                              :total-visible="7"
                              circle
                ></v-pagination>
            </div>
            <v-dialog fullscreen lazy width="80%" v-model="dialog" :persistent="action === 'edit'">
                <v-card class="modal-general-background">
                    <v-card-title class="headline teal lighten-3 white">
                        <v-btn icon dark :disabled="action === 'edit' ? allRequiredFieldIsFully : false"
                               @click="crossBtnTop" class="mb-3">
                            <v-icon>close</v-icon>
                        </v-btn>
                        <h3 class="white-color-text">{{ action === 'add' ? 'Добавление ' + nameModalByRoute :
                            'Редактирование ' + nameModalByRoute}}</h3>
                        <v-spacer></v-spacer>
                        <v-btn color="#7460ee" class="add-button" round @click="methodByAction"
                               :disabled="allRequiredFieldIsFully">Сохранить
                        </v-btn>
                    </v-card-title>
                    <div class="d-flex">
                        <div class="w-50 mt-3 ml-2">
                            <h3 class="text-xs-center mb-5">Основное</h3>
                            <div class="d-inline-flex w-100 justify-content-around">
                                <v-text-field class="mr-2 pl-5"
                                              label="Заголовок"
                                              placeholder="Введите заголовок" outline v-model="modalArticle.title">
                                </v-text-field>
                                <v-text-field class="mr-2 pr-5" label="Краткое описание"
                                              placeholder="Введите краткое описание" outline
                                              v-model="modalArticle.short_description">
                                </v-text-field>
                            </div>
                            <v-textarea
                                    class="mr-2 mt-2 mb-2 pl-5 pr-5"
                                    name="desc"
                                    label="Описание"
                                    outline
                                    hint="Введите подробное описание"
                                    v-model="modalArticle.description"
                            ></v-textarea>
                            <h3 class="text-xs-center mb-5">Мета</h3>
                            <v-text-field class="mr-2 pl-5 pr-5"
                                          label="meta description"
                                          placeholder="Введите meta description" outline
                                          v-model="modalArticle.meta_description"></v-text-field>
                            <v-text-field class="mr-2 pl-5 pr-5"
                                          label="meta keywords"
                                          placeholder="Введите meta keywords" outline
                                          v-model="modalArticle.meta_keywords"></v-text-field>
                            <v-text-field class="mr-2 pl-5 pr-5"
                                          label="meta title"
                                          placeholder="Введите meta title" outline
                                          v-model="modalArticle.meta_title"></v-text-field>
                        </div>
                        <div class="d-flex w-50 flex-column ml-3">
                            <v-layout column>
                                <v-flex xs6>
                                    <h3 class="text-xs-center">Главное фото</h3>
                                    <v-btn
                                            color="blue-grey"
                                            class="white--text ml-3"
                                            @click="emitInputByReference">
                                        {{action && modalArticle.main_image.url? 'Обновить' : 'Загрузить'}}
                                        <v-icon v-if="modalArticle.main_image.url" right dark>update</v-icon>
                                        <v-icon v-else right dark>cloud_upload</v-icon>
                                    </v-btn>
                                    <v-layout align-center justify-space-around row class="w-50">
                                        <input v-if="trigger_image" class="d-none" type="file" multiple ref="mainImage"
                                               @change="changeMainImages()"/>
                                        <div class="images" v-if="modalArticle.main_image.url">
                                            <div class="img-container">
                                                <img :src="modalArticle.main_image.url" alt=""/>
                                                <v-icon color="pink" class="remove-minus-icon"
                                                        @click="removeImage(modalArticle.main_image_id, null, true)">
                                                    remove_circle_outline
                                                </v-icon>
                                                <!--<v-icon color="red" class="remove-minus-icon"-->
                                                <!--@click="emitInputByReference">-->
                                                <!--update-->
                                                <!--</v-icon>-->
                                            </div>
                                        </div>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs6>
                                    <h3 class="text-xs-center mt-3 mb-5">Фотографии</h3>
                                    <v-btn
                                            :disabled="modalArticle.relations.images.length >= 9"
                                            color="blue-grey"
                                            class="white--text ml-3"
                                            @click="fakeEmitInputByReference">
                                        Загрузить
                                        <v-icon right dark>cloud_upload</v-icon>
                                    </v-btn>
                                    <span v-if="modalArticle.relations.images.length === 9" style="color: red"
                                          class="font-weight-bold">Максимальное число изображений: 9</span>
                                    <v-layout align-center justify-space-around row>
                                        <input v-if="trigger_image" class="d-none" type="file" multiple
                                               ref="imageLoader"
                                               @change="handlerImg()"/>
                                        <div class="images" v-if="modalArticle.relations.images">
                                            <div class="img-container mr-3"
                                                 v-for="(img, key) in modalArticle.relations.images"
                                                 :key="key">
                                                <img :src="img.url" alt=""
                                                     @click="modalArticle.main_image_id = img.id">
                                                <v-icon color="pink" class="remove-minus-icon"
                                                        @click="removeImage(img.id, key)">
                                                    remove_circle_outline
                                                </v-icon>
                                            </div>
                                        </div>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </div>
                    </div>
                </v-card>
            </v-dialog>
            <DeleteModal v-bind="{deleteModal, objectOnDelete}" :deleteObject="removeArticle"
                         @emitOnCancel="emitOnCancel"/>
        </div>
    </div>
</template>
<script>
    import {cloneDeep} from 'lodash'
    import DeleteModal from "./DeleteModal";

    export default {
        components: {DeleteModal},
        props: ['clarify_type'],
        data() {
            return {
                trigger_image: true,
                objectOnDelete: {
                    id: '',
                    index: ''
                },
                deleteModal: false,
                active: false,
                action: '',
                dialog: false,
                page: 1,
                last_page: null,
                articles: [],
                articlesHeaders: [
                    {
                        text: '#',
                        value: 'sharp',
                        align: 'center',
                        width: 50,
                        sortable: false
                    },
                    {
                        text: 'Главное фото',
                        value: 'main_photo',
                        align: 'center',
                        width: 160,
                        sortable: false
                    },
                    {
                        text: 'Заголовок',
                        value: 'title',
                        align: 'left',
                        sortable: false,
                    },
                    {
                        text: 'Краткое описание',
                        value: 'short_description',
                        align: 'left',
                        sortable: false
                    },
                    {
                        text: 'Описание',
                        value: 'long_desc',
                        align: 'left',
                        sortable: false
                    },
                    {
                        text: 'Управление',
                        value: 'control',
                        align: 'center',
                        width: 100,
                        sortable: false
                    }
                ],
                modalArticle: {
                    "main_image": {
                        "url": ''
                    },
                    "meta_title": "",
                    "meta_keywords": "",
                    "meta_description": "",
                    "main_image_id": 0,
                    "title": "",
                    "short_description": "",
                    "description": "",
                    "type": this.clarify_type,
                    "relations": {
                        "images": []
                    },
                },
                empty_modal: {},
                mainPhoto: [],
                generalImages: [],
                globalId: null,
                per_page: 5,
            }
        },
        watch: {
            page() {
                this.getArticles()
            }
        },
        methods: {
            emitOnCancel() {
                this.deleteModal = false
            },
            callModalDelete(id, index) {
                this.objectOnDelete = {
                    id: id,
                    index: index
                }
                this.deleteModal = true
            },
            crossBtnTop() {
                this.action = ''
                this.modalArticle = cloneDeep(this.empty_modal);
                this.dialog = false;
            },
            getSelectedArticle(id) {
                this.action = 'edit'
                this.globalId = id
                this.$axios.get(`articles/${id}`, {
                    params: {
                        with: ['mainImage', 'images']
                    }
                })
                    .then(res => {
                        let render_variant = cloneDeep(res.data)
                        render_variant.relations = {
                            images: res.data.images
                        }
                        delete render_variant.images
                        this.modalArticle = render_variant
                        this.modalArticle.main_image = this.modalArticle.main_image ? this.modalArticle.main_image : {
                            created_at: '',
                            id: '',
                            type: '',
                            updated_at: '',
                            url: ''
                        }
                        this.dialog = true
                    })
            },
            removeImage(id, index = null, main = false) {
                this.$axios.delete(`images/${id}`)
                    .then(() => {
                        if (main) {
                            this.modalArticle.main_image_id = null;
                            this.modalArticle.main_image.url = null;
                        } else {
                            this.modalArticle.relations.images.splice(index, 1);
                        }
                    })
            },
            emitAdding() {
                this.modalArticle = cloneDeep(this.empty_modal)
                this.action = 'add'
                this.dialog = true
            },
            handlerImg() {
                this.generalImages = this.$refs['imageLoader'].files;
                this.uploadFiles('all', this.generalImages);
            },
            changeMainImages() {
                this.mainPhoto = this.$refs['mainImage'].files
                this.uploadFiles('mainImage', this.mainPhoto)
            },
            fakeEmitInputByReference() {
                this.$refs['imageLoader'].click()
            },
            emitInputByReference() {
                this.$refs['mainImage'].click()
            },
            uploadFiles(clarify, images) {
                this.trigger_image = false
                let formatData = new FormData();
                for (let i = 0; i <= images.length - 1; i++) {
                    formatData.append('images[]', images[i])
                }
                let size = clarify === 'all' ? 1024 : 1920
                formatData.set('height', size)
                formatData.set('width', size)
                this.$axios.post('images', formatData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(res => {
                            if (clarify === 'mainImage') {
                                this.modalArticle.main_image_id = res.data[0].id
                                this.modalArticle.main_image.url = res.data[0].url
                            } else {
                                this.modalArticle.relations.images = this.limiterImagesCounterToRequire(this.modalArticle.relations.images.concat(res.data), 9)
                            }
                            this.trigger_image = true
                        }
                    )
            },
            getArticles() {
                this.active = true
                this.$axios.get('articles', {
                    params: {
                        paginate: true,
                        page: this.page,
                        per_page: this.per_page,
                        type: this.clarify_type,
                        with: ['mainImage']
                    }
                })
                    .then(res => {
                        this.articles = res.data.data
                        this.last_page = res.data.last_page
                        this.active = false
                    })
            },
            methodByAction() {
                if (!this.modalArticle.main_image_id) {
                    this.modalArticle.main_image_id = this.modalArticle.relations.images[0].id
                }
                let back_copy = cloneDeep(this.modalArticle)
                back_copy.relations.images = back_copy.relations.images.map(_ => _.id)
                if (this.action === 'add') {
                    this.$axios.post('articles', back_copy)
                        .then(res => {
                            if (this.page === 1) {
                                if (this.articles.length < this.per_page) {
                                    this.articles.unshift(res.data)
                                } else {
                                    this.getArticles()
                                }
                            } else {
                                this.getArticles()
                            }
                            this.dialog = false
                        })
                } else {
                    this.$axios.put(`articles/${this.globalId}`,
                        back_copy)
                        .then(res => {
                            this.articles.splice(this.articles.findIndex(el => el.id === this.globalId), 1, res.data)
                            this.dialog = false
                        })
                }
            },
            removeArticle(id, index) {
                this.$axios.delete(`articles/${id}`)
                    .then(() => {
                        this.articles.splice(index, 1)
                        if (this.articles.length > 0) {
                            this.getArticles()
                        } else {
                            this.page--;
                        }
                        this.deleteModal = false
                    })
            }
        },
        computed: {
            nameModalByRoute() {
                return this.clarify_type === 'country' ? 'страны' : 'направления'
            },
            allRequiredFieldIsFully() {
                let {//not req feilds
                    meta_description,
                    meta_keywords,
                    main_image_id,
                    meta_title,
                    relations, ...cleanObj
                } = this.modalArticle
                return Object.values(cleanObj).some(e => e === '' || e === null) || !this.modalArticle.relations.images.length || !this.modalArticle.main_image.url
            }
        },
        created() {
            this.empty_modal = cloneDeep(this.modalArticle)
            this.getArticles()
        },
    }
</script>
