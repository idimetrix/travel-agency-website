<template>
    <div class="justify-content-center">
        <v-card-title class="cart-title-modify">
            <h3 style="padding-left: 20px;">Блог</h3>
        </v-card-title>
        <div class="card-container">
            <v-layout align-center>
                <v-flex xs12 sm12 text-xs-center>
                    <v-card-title class="cart-title-modify">
                        <div class="wrapper-card">
                            <h3 class="text-left" style="margin-top: 10px;">Категории</h3>
                            <div class="text-right w-100">
                                <v-btn flat icon color="primary">
                                    <v-icon v-if="activeCategories" @click.stop="activeCategories = !activeCategories">
                                        expand_less
                                    </v-icon>
                                    <v-icon v-else @click="activeCategories = !activeCategories">
                                        expand_more
                                    </v-icon>
                                </v-btn>
                            </div>
                        </div>
                    </v-card-title>
                </v-flex>
            </v-layout>
            <transition name="slide-fade">
                <div class="h-auto ml-2 category-limiter-width" v-if="activeCategories">
                    <div class="d-inline-flex w-75">
                        <v-btn color="#7460ee" class="add-button" round @click="addCategory"
                               style="flex-grow: 1 !important">Добавить
                        </v-btn>
                        <v-text-field
                                style="flex-grow: 5 !important"
                                label="Категория"
                                v-model="newPost.name"
                                placeholder="Введите новую категорию"
                        ></v-text-field>
                    </div>
                    <v-data-table class="table-custom"
                                  v-if="catShow"
                                  transition="scale-transition"
                                  :headers="category_headers"
                                  hide-actions
                                  :items="categories">
                        <template slot="items" slot-scope="props">
                            <tr style="cursor: pointer">
                                <td class="text-xs-center">{{(props.index+1) + (page-1) * per_page}}</td>
                                <td class="text-xs-left w-50" style="height: 68px;">
                                    <div v-if="!props.item.editCategory">
                                        {{props.item.name}}
                                    </div>
                                    <v-text-field v-else
                                                  v-model="props.item.name"
                                    ></v-text-field>
                                </td>
                                <td class="text-xs-center m-auto">
                                    <v-btn color="#7460ee" v-if="!props.item.editCategory"
                                           @click="props.item.editCategory = !props.item.editCategory"
                                           fab
                                           small
                                           dark>
                                        <v-icon>
                                            border_color
                                        </v-icon>
                                    </v-btn>
                                    <v-btn color="red" v-else @click="putCategory(props.item)" fab small dark>
                                        <i class="material-icons">
                                            done
                                        </i>
                                    </v-btn>
                                    <v-btn color="red" fab small dark
                                           @click="deleteCategory(props.item.id, props.index)">
                                        —
                                    </v-btn>
                                </td>
                            </tr>
                        </template>
                    </v-data-table>
                    <div class="text-xs-center" v-if="pagesSize !== null">
                        <v-pagination color="#4db6ac"
                                      v-model="page"
                                      :length="pagesSize"
                                      :total-visible="7"
                                      circle
                        ></v-pagination>
                    </div>
                </div>
            </transition>
        </div>
        <div class="card-container">
            <v-layout align-center>
                <v-flex xs12 sm12 text-xs-center>
                    <v-card-title class="cart-title-modify">
                        <div class="wrapper-card">
                            <h3 class="text-left" style="margin-top: 10px;">Записи</h3>
                            <div class="text-right w-100">
                                <v-btn flat icon color="primary">
                                    <v-icon v-if="activePosts" @click="activePosts = !activePosts">
                                        expand_less
                                    </v-icon>
                                    <v-icon v-else @click="activePosts = !activePosts">
                                        expand_more
                                    </v-icon>
                                </v-btn>
                            </div>
                        </div>
                    </v-card-title>
                </v-flex>
            </v-layout>
            <transition name="slide-fade">
                <div class="h-auto ml-2" v-show="activePosts">
                    <v-btn color="#7460ee" class="add-button" round @click="addNewPost">Добавить пост</v-btn>
                    <v-data-table class="table-custom"
                                  transition="scale-transition"
                                  :headers="posts_headers"
                                  hide-actions
                                  :items="posts"
                                  :loading="active">
                        <v-progress-linear slot="progress" color="info" indeterminate></v-progress-linear>
                        <template slot="items" slot-scope="props">
                            <tr style="cursor: pointer" @click="showInfoPost(props.item.id)" v-if="!active">
                                <td class="text-xs-left">
                                    <div class="image-container-for-table" v-if="props.item.main_image">
                                        <v-avatar v-if="props.item.main_image.url"
                                                  :size="130"
                                                  color="grey lighten-4"
                                                  class="mt-2 mb-2">
                                            <img :src="props.item.main_image.url" alt=""/>
                                        </v-avatar>
                                    </div>
                                </td>
                                <td class="text-xs-center">{{props.item.category_id}}</td>
                                <td class="text-xs-center">{{props.item.title}}</td>
                                <td class="text-xs-left">{{props.item.short_description}}</td>
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
                    <div class="text-xs-center" v-show="!active">
                        <v-pagination color="#4db6ac"
                                      v-if="pagePostsListSize"
                                      v-model="pagePostsList"
                                      :length="pagePostsListSize"
                                      :total-visible="7"
                                      circle
                        ></v-pagination>
                    </div>
                </div>
            </transition>
        </div>
        <v-dialog v-model="dialog"
                  lazy
                  fullscreen transition="slide-y-transition">
            <v-card>
                <v-card-title class="headline teal lighten-3 white">
                    <v-btn icon dark v-if="modalState === 'adding'"
                           @click="dialog = false" class="mb-3">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-btn icon dark v-else :disabled="anyRequiredFieldOrImagesIsEmpty" @click="dialog = false"
                           class="mb-3">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <h3 class="white-color-text">{{modalState === 'adding' ?
                        'Добавление нового поста' : 'Просмотр и редактирование'}}</h3>
                    <v-spacer></v-spacer>
                    <v-btn color="#7460ee" class="add-button" round @click="savePost"
                           :disabled="anyRequiredFieldOrImagesIsEmpty">Сохранить
                    </v-btn>
                </v-card-title>
                <div class="d-flex justify-content-between w-100 h-100">
                    <div class="d-flex w-50 flex-column">
                        <h3 class="text-center">Основное</h3>
                        <div class="d-flex justify-content-around mt-3">
                            <v-text-field class="mr-2 ml-1"
                                          label="Название"
                                          placeholder="Введите название поста"
                                          outline
                                          v-model="current_post.title"
                            ></v-text-field>
                            <v-flex xs12 sm6 d-flex>
                                <v-select style="overflow-x: hidden;"
                                          v-model="current_post.category_id"
                                          :items="modalCategories"
                                          label="Название категории"
                                          outline
                                          item-text="name"
                                          item-value="id"
                                >
                                </v-select>
                            </v-flex>
                            <!--<v-text-field class="mr-2"-->
                            <!--label="Название категории"-->
                            <!--placeholder="Выберите название категории"-->
                            <!--outline-->
                            <!--v-model="current_post.category_id"-->
                            <!--&gt;</v-text-field>-->
                        </div>
                        <div class="d-flex justify-content-around mt-3 ml-1">
                            <v-text-field class="mr-2"
                                          label="Meta title"
                                          placeholder="Enter meta title"
                                          outline
                                          v-model="current_post.meta_title"
                            ></v-text-field>
                            <v-text-field class="mr-2"
                                          label="Meta keywords"
                                          placeholder="Enter meta keywords"
                                          outline
                                          v-model="current_post.meta_keywords"
                            ></v-text-field>
                            <v-text-field class="mr-2"
                                          label="Meta description"
                                          placeholder="Enter meta description"
                                          outline
                                          v-model="current_post.meta_description"
                            ></v-text-field>
                        </div>
                        <div class="d-flex justify-content-around mt-3 ml-1">
                            <v-textarea
                                    class="mr-2"
                                    name="desc"
                                    style="height: 150px"
                                    label="Короткое описание поста"
                                    outline
                                    v-model="current_post.short_description"
                            ></v-textarea>
                        </div>
                        <div>
                            <h3 class="text-center mt-2 mb-2">Подробное описание</h3>
                            <vue-editor style="width:98%; margin: 0 auto;"
                                        v-model="current_post.description"></vue-editor>
                        </div>
                        <!--<v-textarea-->
                        <!--class="mr-2"-->
                        <!--name="desc"-->
                        <!--style="height: 250px"-->
                        <!--label="Описание поста"-->
                        <!--outline-->
                        <!--v-model="current_post.description"-->
                        <!--&gt;</v-textarea>-->
                    </div>
                    <div class="d-flex w-50 flex-column ml-3">
                        <v-flex xs12 style="max-height: 300px;height: 100%">
                            <h3 class="text-xs-center">Главное фото</h3>
                            <v-btn
                                    color="blue-grey"
                                    class="white--text ml-3"
                                    @click="fakeEmitInputByReferenceMainPhoto">
                                {{modalState && current_post.main_image.url? 'Обновить' : 'Загрузить'}}
                                <v-icon v-if="current_post.main_image.url" right dark>update</v-icon>
                                <v-icon v-else right dark>cloud_upload</v-icon>
                            </v-btn>
                            <v-layout align-center justify-space-around row class="w-50">
                                <input v-if="trigger_image" class="d-none" type="file" multiple ref="mainImage"
                                       @change="handlerMainImg()"/>
                                <div class="images" v-if="current_post.main_image.url">
                                    <div class="img-container">
                                        <img :src="current_post.main_image.url" alt=""/>
                                        <v-icon color="pink" class="remove-minus-icon"
                                                @click="removeImage(current_post.main_image_id, null, true)">
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
                        <v-flex xs12>
                            <h3 class="text-xs-center mt-3 mb-5">Фотографии</h3>
                            <v-btn
                                    :disabled="current_post.relations.images.length >= 9"
                                    color="blue-grey"
                                    class="white--text ml-3"
                                    @click="fakeEmitInputByReference">
                                Загрузить
                                <v-icon right dark>cloud_upload</v-icon>
                            </v-btn>
                            <span v-if="current_post.relations.images.length === 9" style="color: red"
                                  class="font-weight-bold">Максимальное число изображений: 9</span>
                            <v-layout align-center justify-space-around row>
                                <input v-if="trigger_image" class="d-none" type="file" multiple ref="imageLoader"
                                       @change="handlerImg()"/>
                                <div class="images" v-if="current_post.relations.images.length">
                                    <div class="img-container mr-3"
                                         v-for="(img, key) in current_post.relations.images"
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
                    <!--<v-btn-->
                    <!--color="blue-grey"-->
                    <!--class="white&#45;&#45;text ml-3"-->
                    <!--@click="fakeEmitInputByReference"-->
                    <!--&gt;-->
                    <!--Загрузить-->
                    <!--<v-icon right dark>cloud_upload</v-icon>-->
                    <!--</v-btn>-->
                    <!--<input class="d-none" type="file" multiple ref="imageLoader" @change="handlerImg()">-->
                    <!--<p class="ml-3">Необходимо выбрать основное фото! <br> <span-->
                    <!--v-if="!current_post.main_image_id"-->
                    <!--class="font-weight-bold">-->
                    <!--Если фото выбрано не будет, то основным будет установлено первое в списке!-->
                    <!--</span> <br><span v-if="current_post.relations.images.length === 9" style="color: red"-->
                    <!--class="font-weight-bold">Максимальное число изображений: 9</span></p>-->
                    <!--<div class="images" v-if="current_post.relations.images.length">-->
                    <!--<div class="img-container" v-for="(img, key) in current_post.relations.images" :key="key">-->
                    <!--<img class="modal-image" :src="img.url" alt=""-->
                    <!--@click="current_post.main_image_id = img.id">-->
                    <!--<v-icon x-large color="green" class="absolute-icon"-->
                    <!--v-if="img.id === current_post.main_image_id"> check_circle_outline-->
                    <!--</v-icon>-->
                    <!--<v-icon color="pink" class="remove-minus-icon" @click="removeImage(img.id, key)">-->
                    <!--remove_circle_outline-->
                    <!--</v-icon>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                </div>
            </v-card>
        </v-dialog>
        <DeleteModal v-bind="{deleteModal, objectOnDelete}" :deleteObject="deletePost" @emitOnCancel="emitOnCancel"/>
    </div>
</template>
<script>
    import {cloneDeep} from 'lodash'
    import DeleteModal from "./DeleteModal";
    import {VueEditor} from "vue2-editor";

    export default {
        components: {DeleteModal, VueEditor},
        slug: 'BlogComponent',
        data() {
            return {
                description: '',
                trigger_image: true,
                objectOnDelete: {
                    id: '',
                    index: ''
                },
                deleteModal: false,
                active: false,
                showTable: true,
                menu: [
                    'Список категорий',
                    'Посты'
                ],
                action: '',
                dialog: false,
                current_post: {
                    "category_id": null,
                    "meta_title": "",
                    "meta_keywords": "",
                    "meta_description": "",
                    "main_image": {
                        "url": ''
                    },
                    "id": '',
                    "main_image_id": '',
                    "title": "",
                    "short_description": "",
                    "description": "",
                    "relations": {
                        "images": []
                    }
                },
                pagePostsList: 1,
                pagePostsListSize: null,
                activeCategories: true,
                activePosts: true,
                page: 1,
                pagesSize: null,
                catShow: true,
                categories: [],
                category_headers: [
                    {
                        text: '#',
                        value: 'sharp',
                        sortable: false,
                        align: 'center'
                    },
                    {
                        text: 'Название',
                        value: 'name',
                        sortable: false,
                        align: 'left'
                    },
                    {
                        text: 'Управление',
                        value: 'control',
                        sortable: false,
                        align: 'center'
                    }
                ],
                posts_headers: [
                    {
                        text: 'Фото',
                        value: 'control',
                        sortable: false,
                        align: 'center',
                        width: 160
                    },
                    {
                        text: 'Категория',
                        value: 'control',
                        sortable: false,
                        align: 'center'
                    },
                    {
                        text: 'Название',
                        value: 'control',
                        sortable: false,
                        align: 'center'
                    },
                    {
                        text: 'Описание',
                        value: 'control',
                        sortable: false,
                        align: 'center'
                    },
                    {
                        text: 'Управление',
                        value: 'control',
                        sortable: false,
                        align: 'center'
                    }
                ],
                posts: [],
                newPost: {
                    name: ''
                },
                mainImage: [],
                generalImages: [],
                modalState: 'editing',
                globalEditableId: '',
                modalCategories: [],
                per_page: 5,
                activeClose: false,
                editClose: false,
            }
        },
        watch: {
            page() {
                this.getCategories(true)
            },
            pagePostsList() {
                this.getPostsList()
            },
        },
        computed: {
            anyRequiredFieldOrImagesIsEmpty() {
                let { //not required fields
                    meta_description,
                    meta_keywords,
                    meta_title,
                    relations,
                    ...scaning_copy
                } = this.current_post
                return Object.values(scaning_copy).some(_ => _ === '' || _ === null) || !this.current_post.relations.images.length
            },
        },
        methods: {
            emitOnCancel() {
                this.deleteModal = false
            }
            ,
            callModalDelete(id, index) {
                this.objectOnDelete = {
                    id: id,
                    index: index
                }
                this.deleteModal = true
            },
            putCategory(item) {
                item.editCategory = !item.editCategory
                this.$axios.put(`categories/${item.id}`, {
                    name: item.name
                })
                    .then(res => {
                        item.editCategory = false
                    })
            }
            ,
            selectSubMenu(item) {
                if (item === 'Посты') {
                    this.activePosts = true
                    this.activeCategories = false
                } else {
                    this.activeCategories = true
                    this.activePosts = false
                }
            }
            ,
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
                                this.current_post.main_image_id = res.data[0].id
                                this.current_post.main_image.url = res.data[0].url
                            } else {
                                this.current_post.relations.images = this.limiterImagesCounterToRequire(this.current_post.relations.images.concat(res.data), 9)
                            }
                            this.trigger_image = true
                        }
                    )
            },
            handlerMainImg() {
                this.mainImage = this.$refs['mainImage'].files;
                this.uploadFiles('mainImage', this.mainImage);
            }
            ,
            handlerImg() {
                this.generalImages = this.$refs['imageLoader'].files;
                this.uploadFiles('imageLoader', this.generalImages);
            }
            ,
            addNewPost() {
                this.getCategories(false)
                this.current_post = {
                    "category_id": null,
                    "meta_title": "",
                    "meta_keywords": "",
                    "meta_description": "",
                    "main_image_id": "",
                    "title": "",
                    "main_image": {
                        "url": ''
                    },
                    "short_description": "",
                    "description": "",
                    "relations": {
                        "images": []
                    }
                }
                this.modalState = 'adding';
                this.dialog = true;
            },
            changeState() {
                this.modalState = 'editing'
                this.dialog = true
            }
            ,
            removeImage(id, index = null, main) {
                this.$axios.delete(`images/${id}`)
                    .then(() => {
                        if (main) {
                            this.current_post.main_image_id = null;
                            this.current_post.main_image.url = null;
                        } else {
                            this.current_post.relations.images.splice(index, 1);
                        }
                    })
            }
            ,
            fakeEmitInputByReference() {
                this.$refs['imageLoader'].click()
            }
            ,
            fakeEmitInputByReferenceMainPhoto() {
                this.$refs['mainImage'].click()
            }
            ,
            savePost() {
                if (!this.current_post.main_image_id) {
                    this.current_post.main_image_id = this.current_post.relations.images[0].id
                }
                let render_copy = cloneDeep(this.current_post);
                render_copy.relations.images = render_copy.relations.images.map(e => e.id)
                switch (this.modalState) {
                    case 'adding' :
                        this.$axios.post('posts', render_copy)
                            .then(res => {
                                if (this.pagePostsList === 1) {
                                    if (this.posts.length < this.per_page) {
                                        this.posts.unshift(res.data)
                                    } else {
                                        this.getPostsList()
                                    }
                                } else {
                                    this.getPostsList()
                                }
                                this.dialog = false;
                            });
                        break;
                    case 'editing':
                        this.$axios.put(`posts/${this.globalEditableId}`, render_copy)
                            .then(res => {
                                this.posts.splice(this.posts.findIndex(e => e.id === this.globalEditableId), 1, res.data)
                                this.getPostsList()
                                this.dialog = false
                            });
                        break;
                }
            }
            ,
            showInfoPost(id) {
                this.getCategories(false)
                this.modalState = 'editing';
                this.globalEditableId = id
                this.$axios.get(`posts/${id}`, {
                    params: {
                        with: ['mainImage', 'images'],
                    }
                })
                    .then((res) => {
                        let render_variant = cloneDeep(res.data)
                        render_variant.relations = {
                            images: res.data.images
                        }
                        delete render_variant.images
                        this.current_post = render_variant;
                        this.current_post.main_image = this.current_post.main_image ? this.current_post.main_image : {
                            created_at: '',
                            id: '',
                            type: '',
                            updated_at: '',
                            url: ''
                        }
                        this.dialog = true;
                    })
            }
            ,
            deleteCategory(id, index) {
                this.$axios.delete(`categories/${id}`)
                    .then(() => {
                        this.categories.splice(index, 1)
                        if (this.categories.length > 0) {
                            this.getCategories(true)
                        } else {
                            this.page--;
                        }
                        this.getCategories(true)
                    })
            }
            ,
            deletePost(id, index) {
                this.$axios.delete(`posts/${id}`)
                    .then(() => {
                        this.posts.splice(index, 1)
                        if (this.posts.length > 0) {
                            this.getPostsList()
                        } else {
                            this.pagePostsList--;
                        }
                        this.deleteModal = false
                    })
            }
            ,
            getCategories(pagination) {
                this.$axios.get('categories', {
                    params: {
                        paginate: pagination,
                        page: this.page,
                        per_page: this.per_page,
                    }
                })
                    .then(res => {
                        if (pagination) {
                            this.pagesSize = res.data.last_page
                            this.categories = res.data.data
                            this.categories.forEach(el => {
                                this.$set(el, 'editCategory', false)
                            })
                        } else {
                            this.modalCategories = res.data
                        }
                    })
            }
            ,
            getPostsList() {
                this.active = true
                this.$axios.get('posts', {
                    params: {
                        with: ['mainImage'],
                        paginate: true,
                        per_page: this.per_page,
                        page: this.pagePostsList
                    }
                })
                    .then(res => {
                        this.pagePostsListSize = res.data.last_page
                        this.posts = res.data.data
                        this.posts.forEach((el, index, object) => {
                            let idx = this.categories.findIndex(_ => _.id === el.category_id)
                            if (idx !== -1) {
                                object[index].category_id = this.categories[idx].name
                            }
                        })
                        this.active = false
                    })
            }
            ,
            addCategory() {
                this.$axios.post('categories', this.newPost)
                    .then(res => {
                        this.categories[0].id = res.data.id
                        if (this.page === 1) {
                            if (this.categories.length < this.per_page) {
                                this.categories.unshift(res.data)
                            } else {
                                this.getCategories(true)
                            }
                        } else {
                            this.getCategories(true)
                        }
                        this.dialog = false
                    })
            }
        }
        ,
        created() {
            this.getCategories(true)
            this.getPostsList()
            let place = localStorage.getItem('last_admin_creator')
            if (place !== this.$options.slug) {
                localStorage.setItem('last_admin_creator', this.$options.slug)
            }
        }
    }
</script>
<style scoped lang="scss">
    html, body {
        overflow: hidden;
    }

    .rating-star {
        width: 15px;
        height: 15px;
        margin: 0 3px;
        cursor: pointer;
    }

    .v-textarea textarea {
        min-height: 220px !important;
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }

    .slide-fade-leave-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter {
        transform: translateY(5px);
        opacity: 0;
    }

    .slide-fade-leave-to {
        transform: translateY(-5px);
        opacity: 0;
    }

    .wrapper-card {
        display: flex;
        width: 100%;
        flex-direction: row;
        text-align: right;
        justify-content: center;
    }

</style>
