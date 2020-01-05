<template>
    <div class="justify-content-center">
        <v-card-title class="cart-title-modify">
            <h3>Туры</h3>
        </v-card-title>
        <div class="card-container height-table-options">
            <v-btn color="#7460ee" class="add-button" round @click.stop="addTour">Добавить</v-btn>
            <v-data-table
                    :headers="headers"
                    hide-actions
                    class="table-custom"
                    :items="tours"
                    :loading="active">
                <v-progress-linear slot="progress" color="info" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="props">
                    <tr @click="getSelectedTour(props.item.id)" style="cursor: pointer" v-if="!active"
                        :style="{background: props.item.is_hot ? '#b3d2cf36' : ''}">
                        <td class="text-xs-center">{{(props.index+1) + (page-1) * per_page}}</td>
                        <td class="text-xs-left">
                            <div class="image-container-for-table" v-if="props.item.main_image">
                                <v-avatar v-if="props.item.main_image.url"
                                          :size="130"
                                          color="grey lighten-4"
                                          class="mt-2 mb-2">
                                    <img :src="props.item.main_image.url" alt="">
                                </v-avatar>
                            </div>
                        </td>
                        <td class="text-xs-left">{{props.item.country}}, {{props.item.city}}</td>
                        <!--<td class="text-xs-left">{{props.item.hotel}}</td>-->
                        <td class="text-xs-center">{{props.item.duration}}</td>
                        <td class="text-xs-center">{{props.item.tourists_number}} чел</td>
                        <td class="text-xs-center">{{props.item.price}} руб.</td>
                        <td class="text-xs-center">
                            <div>
                                <v-btn color="red" fab small dark
                                       @click.stop="callModalDelete(props.item.id, props.index)">
                                    —
                                </v-btn>
                            </div>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <div class="text-xs-center" v-if="tours.length" v-show="!active">
                <v-pagination color="#4db6ac!important"
                              v-model="page"
                              :length="pagesSize"
                              :total-visible="7"
                              circle
                ></v-pagination>
            </div>
        </div>
        <v-dialog v-model="dialog"
                  lazy
                  fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card class="tour-modal modal-general-background">
                <v-card-title class="headline teal lighten-3 white">
                    <v-btn :disabled="modalState === 'editing' ? anyRequiredFieldOrImagesIsEmpty() : false" icon dark
                           @click="crossBtnTop" class="mb-2">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <h3 class="white-color-text">{{modalState === 'adding' ?
                        'Добавление нового тура' : 'Просмотр и редактирование'}}</h3>
                    <v-spacer></v-spacer>
                    <v-btn color="#7460ee" class="add-button" round @click="saveTour"
                           :disabled="anyRequiredFieldOrImagesIsEmpty()">Сохранить
                    </v-btn>
                </v-card-title>
                <div class="d-flex justify-content-between mt-2 ml-2 mr-2" style="width: 99%">
                    <div class="d-flex w-50 flex-column">
                        <h3 class="text-center">Основное</h3>
                        <v-checkbox v-model="modalTour.is_hot" label="Горящий тур"></v-checkbox>
                        <div class="d-flex justify-content-around">
                            <v-text-field class="mr-2"
                                          label="Страна"
                                          placeholder="Введите страну"
                                          outline
                                          v-model="modalTour.country"
                            ></v-text-field>
                            <v-text-field class="mr-2"
                                          label="Город"
                                          placeholder="Введите город"
                                          outline
                                          v-model="modalTour.city"
                            ></v-text-field>
                            <!--<v-text-field class="mr-2"-->
                            <!--label="Отель"-->
                            <!--placeholder="Введите название отеля"-->
                            <!--outline-->
                            <!--v-model="modalTour.hotel"-->
                            <!--&gt;</v-text-field>-->
                        </div>
                        <div class="d-flex justify-content-around mt-3">
                            <v-text-field class="mr-2"
                                          label="Длительность"
                                          placeholder="Введите длительность"
                                          outline
                                          v-model="modalTour.duration"
                            ></v-text-field>
                            <v-text-field class="mr-2"
                                          label="Количество туристов"
                                          placeholder="Введите количетство туристов"
                                          outline
                                          v-model="modalTour.tourists_number"
                            ></v-text-field>
                            <v-flex xs12 sm6 md4>
                                <v-menu
                                        :close-on-content-click="false"
                                        v-model="picker"
                                        :nudge-right="40"
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        min-width="290px"
                                >
                                    <v-text-field
                                            slot="activator"
                                            :value="humanityTimeView(modalTour.departure_date)"
                                            label="Выберите дату"
                                            prepend-icon="event"
                                            readonly
                                    ></v-text-field>
                                    <v-date-picker v-model="modalTour.departure_date"
                                                   locale="ru"
                                                   @input="picker = false"></v-date-picker>
                                </v-menu>
                            </v-flex>
                        </div>
                        <h3 class="text-center">Подробное описание</h3>
                        <v-textarea
                                name="desc"
                                style="height: 250px"
                                label="Описание тура"
                                outline
                                hint="Описание"
                                v-model="modalTour.description"
                        ></v-textarea>
                        <h3 class="text-center">Дополнительно</h3>
                        <div class="d-flex mt-3 justify-content-around">
                            <v-text-field class="mr-2"
                                          label="Стоимость"
                                          placeholder="Введите стоимость"
                                          outline
                                          v-model="modalTour.price"
                            ></v-text-field>
                            <v-text-field class="mr-2"
                                          label="Еда"
                                          placeholder="Питание"
                                          outline
                                          v-model="modalTour.food"
                            ></v-text-field>
                            <v-text-field class="mr-2"
                                          label="Примечание"
                                          placeholder="Введите примечание"
                                          outline
                                          v-model="modalTour.note"
                            ></v-text-field>
                        </div>
                        <h3 class="text-center mt-3">Мета</h3>
                        <div class="d-flex mt-3 justify-content-around">
                            <v-text-field class="mr-2"
                                          label="title"
                                          placeholder="Введите title"
                                          outline
                                          v-model="modalTour.meta_title"
                            ></v-text-field>
                            <v-text-field class="mr-2"
                                          label="meta description"
                                          placeholder="Введите meta description"
                                          outline
                                          v-model="modalTour.meta_description"
                            ></v-text-field>
                            <v-text-field class="mr-2"
                                          label="meta keywords"
                                          placeholder="Введите meta keywords"
                                          outline
                                          v-model="modalTour.meta_keywords"
                            ></v-text-field>
                        </div>
                    </div>
                    <div class="d-flex w-50 flex-column ml-3">
                        <v-flex>
                            <h3 class="text-xs-center">Главное фото</h3>
                            <v-btn
                                    color="blue-grey"
                                    class="white--text ml-3"
                                    @click="fakeEmitInputByReferenceMainPhoto">
                                {{modalState && modalTour.main_image.url ?
                                'Обновить' : 'Загрузить'}}
                                <v-icon v-if="modalTour.main_image.url" right dark>update</v-icon>
                                <v-icon v-else right dark>cloud_upload</v-icon>
                            </v-btn>
                            <v-layout align-center justify-space-around row class="w-50">
                                <input v-if="trigger_image" class="d-none" type="file" multiple ref="mainImage"
                                       @change="handlerMainImg()"/>
                                <div class="images" v-if="modalTour.main_image.url">
                                    <div class="img-container">
                                        <img :src="modalTour.main_image.url" alt=""/>
                                        <v-icon color="pink" class="remove-minus-icon"
                                                @click="removeImage(modalTour.main_image_id, null, true)">
                                            remove_circle_outline
                                        </v-icon>
                                        <!--<v-icon color="red" class="remove-minus-icon"-->
                                        <!--@click="fakeEmitInputByReferenceMainPhoto">-->
                                        <!--update-->
                                        <!--</v-icon>-->
                                    </div>
                                </div>
                            </v-layout>
                        </v-flex>
                        <v-flex xs6>
                            <h3 class="text-xs-center mt-3 mb-5">Фотографии</h3>
                            <v-btn
                                    :disabled="modalTour.relations.images.length >= 9"
                                    color="blue-grey"
                                    class="white--text ml-3"
                                    @click="fakeEmitInputByReference">
                                Загрузить
                                <v-icon right dark>cloud_upload</v-icon>
                            </v-btn>
                            <span v-if="modalTour.relations.images.length === 9" style="color: red"
                                  class="font-weight-bold">Максимальное число изображений: 9</span>
                            <v-layout align-center justify-space-around row>
                                <input v-if="trigger_image" class="d-none" type="file" multiple ref="imageLoader"
                                       @change="handlerImg()"/>
                                <div class="images" v-if="modalTour.relations.images.length">
                                    <div class="img-container mr-3"
                                         v-for="(img, key) in modalTour.relations.images"
                                         :key="key">
                                        <img :src="img.url" alt="">
                                        <v-icon color="pink" class="remove-minus-icon"
                                                @click="removeImage(img.id, key)">
                                            remove_circle_outline
                                        </v-icon>
                                    </div>
                                </div>
                            </v-layout>
                        </v-flex>
                    </div>
                    <!--<div class="w-50 pl-3">-->
                    <!--<h3 class="text-center">Фотографии</h3>-->
                    <!--<v-btn :disabled="modalTour.relations.images.length >=9"-->
                    <!--color="blue-grey"-->
                    <!--class="white&#45;&#45;text ml-3"-->
                    <!--@click="fakeEmitInputByReference"-->
                    <!--&gt;-->
                    <!--Загрузить-->
                    <!--<v-icon right dark>cloud_upload</v-icon>-->
                    <!--</v-btn>-->
                    <!--<input class="d-none" type="file" multiple ref="imageLoader" @change="handlerImg()">-->
                    <!--<p class="ml-3">Необходимо выбрать основное фото! <br> <span-->
                    <!--v-if="!modalTour.main_image_id"-->
                    <!--class="font-weight-bold">-->
                    <!--Если фото выбрано не будет, то основным будет установлено первое в списке!-->
                    <!--</span><br> <span v-if="modalTour.relations.images.length === 9" style="color: red"-->
                    <!--class="font-weight-bold">Максимальное число изображений: 9</span></p>-->
                    <!--<div class="images" v-if="modalTour.relations.images.length">-->
                    <!--<div class="img-container" v-for="(img, key) in modalTour.relations.images" :key="key">-->
                    <!--<img class="modal-image" :src="img.url" alt=""-->
                    <!--@click="modalTour.main_image_id = img.id">-->
                    <!--<v-icon x-large color="green" class="absolute-icon"-->
                    <!--v-if="img.id === modalTour.main_image_id"> check_circle_outline-->
                    <!--</v-icon>-->
                    <!--<v-icon color="pink" class="remove-minus-icon" @click="removeImage(img.id, key)">-->
                    <!--remove_circle_outline-->
                    <!--</v-icon>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                </div>
            </v-card>
        </v-dialog>
        <DeleteModal v-bind="{deleteModal, objectOnDelete}" :deleteObject="permanentlyDeleteTour"
                     @emitOnCancel="emitOnCancel"/>
    </div>
</template>
<script>
    import {cloneDeep} from 'lodash';
    import moment from 'moment'
    import DeleteModal from "./DeleteModal";

    let empty_copy = {}
    export default {
        components: {DeleteModal},
        slug: 'HotTours',
        data() {
            let humanity_date = moment().format('YYYY-MM-DD')
            return {
                trigger_image: true,
                objectOnDelete: {
                    id: '',
                    index: ''
                },
                deleteModal: false,
                active: false,
                page: 1,
                pagesSize: null,
                picker: false,
                images: [],
                dialog: false,
                tours: [],
                headers: [
                    {
                        text: '#',
                        align: 'center',
                        value: 'sharp',
                        width: 80,
                        sortable: false,
                    },
                    {
                        text: 'Фото',
                        align: 'center',
                        sortable: false,
                        value: 'main_photo',
                        width: 160,
                    },
                    {
                        text: 'Страна, город',
                        align: 'left',
                        value: 'short_ways',
                        sortable: false
                    },
                    // {
                    //     text: 'Отель',
                    //     align: 'left',
                    //     value: 'hotel',
                    //     sortable: false
                    // },
                    {
                        text: 'Длительность тура',
                        align: 'center',
                        value: 'duration',
                        sortable: false
                    },

                    {
                        text: 'Количество туристов',
                        align: 'center',
                        value: 'count_tourists',
                        sortable: false
                    },
                    {
                        text: 'Цена',
                        align: 'center',
                        value: 'price',
                        sortable: false
                    },
                    {
                        text: 'Управление',
                        align: 'center',
                        width: 80,
                        value: 'delete',
                        sortable: false
                    }
                ],
                modalTour: {
                    "meta_title": "",
                    "meta_keywords": "",
                    "meta_description": "",
                    "country": "",
                    "city": "",
                    "duration": null,
                    "tourists_number": null,
                    "departure_date": humanity_date,
                    "food": "",
                    "note": "",
                    "main_image_id": 0,
                    "description": "",
                    "price": null,
                    "main_image": {
                        "url": ''
                    },
                    "relations": {
                        "images": []
                    },
                    "is_hot": false
                },
                mainImage: [],
                generalImages: [],
                modalState: '',
                globalEditableId: '',
                per_page: 5
            }
        },
        watch: {
            page() {
                this.getTours()
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
            permanentlyDeleteTour(id, index) {
                this.$axios.delete(`tours/${id}`)
                    .then(() => {
                        this.tours.splice(index, 1)
                        if (this.tours.length > 0) {
                            this.getTours()
                        } else {
                            this.page--;
                        }
                    })
                this.deleteModal = false
            },
            crossBtnTop() {
                this.modalTour = cloneDeep(empty_copy);
                this.dialog = false;
            },
            removeImage(id, index = null, main = false) {
                this.$axios.delete(`images/${id}`)
                    .then(() => {
                        if (main) {
                            this.modalTour.main_image_id = null;
                            this.modalTour.main_image.url = null;
                        } else {
                            this.modalTour.relations.images.splice(index, 1);
                        }

                    })
            },
            fakeEmitInputByReference() {
                this.$refs['imageLoader'].click()
            },
            fakeEmitInputByReferenceMainPhoto() {
                this.$refs['mainImage'].click()
            },
            saveTour() {
                if (!this.modalTour.main_image_id) {
                    this.modalTour.main_image_id = this.modalTour.relations.images[0].id
                }
                let render_copy = cloneDeep(this.modalTour);
                render_copy.relations.images = render_copy.relations.images.map(e => e.id)
                switch (this.modalState) {
                    case 'adding' :
                        this.$axios.post('tours', render_copy)
                            .then(res => {
                                if (this.page === 1) {
                                    if (this.tours.length < this.per_page) {
                                        this.tours.unshift(res.data)
                                    } else {
                                        this.getTours()
                                    }
                                } else {
                                    this.getTours()
                                }
                                this.modalTour = cloneDeep(empty_copy)
                                this.dialog = false;
                            });
                        break;
                    case 'editing':
                        this.$axios.put(`tours/${this.globalEditableId}`, render_copy)
                            .then(res => {
                                this.tours.splice(this.tours.findIndex(e => e.id === this.globalEditableId), 1, res.data)
                                this.modalTour = cloneDeep(empty_copy);
                                this.dialog = false
                            });
                        break;
                }
            },
            handlerImg() {
                this.generalImages = this.$refs['imageLoader'].files;
                this.uploadFiles('imageLoader', this.generalImages);
            },
            handlerMainImg() {
                this.mainImage = this.$refs['mainImage'].files;
                this.uploadFiles('mainImage', this.mainImage);
            },
            uploadFiles(clarify, images) {
                this.trigger_image = false
                let formatData = new FormData();
                for (let i = 0; i <= images.length - 1; i++) {
                    formatData.append('images[]', images[i])
                }
                let size = clarify === 'mainImage' ? 1920 : 1024
                formatData.set('height', size)
                formatData.set('width', size)
                this.$axios.post('images', formatData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(
                        res => {
                            if (clarify === 'mainImage') {
                                this.modalTour.main_image_id = res.data[0].id
                                this.modalTour.main_image.url = res.data[0].url
                            } else {
                                this.modalTour.relations.images = this.limiterImagesCounterToRequire(this.modalTour.relations.images.concat(res.data), 9)
                            }
                            this.trigger_image = true
                        }
                    )
            },
            getSelectedTour(id) {
                this.modalState = 'editing';
                this.globalEditableId = id
                this.$axios.get(`tours/${id}`, {
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
                        this.modalTour = render_variant;
                        this.modalTour.main_image = this.modalTour.main_image ? this.modalTour.main_image : {
                            created_at: '',
                            id: '',
                            type: '',
                            updated_at: '',
                            url: ''
                        }
                        this.dialog = true;
                    });
                // event.stopImmediatePropagation()
            },
            addTour() {
                this.modalState = 'adding';
                this.dialog = true;
            },
            getTours() {
                this.active = true
                this.$axios.get('tours', {
                    params: {
                        with: ['mainImage'],
                        paginate: true,
                        page: this.page,
                        per_page: this.per_page
                    }
                })
                    .then(res => {
                        this.pagesSize = res.data.last_page
                        this.tours = res.data.data
                        this.active = false
                    })
            },
            parseDate(date) {
                if (!date) return null
                const [month, day, year] = date.split('/')
                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
            },
            anyRequiredFieldOrImagesIsEmpty() {
                let {
                    meta_description,
                    meta_keywords,
                    meta_title,
                    relations,
                    is_hot,
                    hotel,
                    ...scaning_copy
                } = this.modalTour
                return Object.values(scaning_copy).some(_ => _ === '' || _ === null) || !this.modalTour.relations.images.length
            }
        },
        created() {
            empty_copy = cloneDeep(this.modalTour);
            this.getTours();
            let place = localStorage.getItem('last_admin_creator')
            if (place !== this.$options.slug) {
                localStorage.setItem('last_admin_creator', this.$options.slug)
            }
        }
    }
</script>
<style scoped lang="scss">
    .v-textarea textarea {
        min-height: 220px !important;
    }
</style>