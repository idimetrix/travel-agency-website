<template>
    <div class="justify-content-center">
        <v-card-title class="cart-title-modify">
            <h3>
                Отзывы
            </h3>
        </v-card-title>
        <div class="card-container">
            <v-card-title class="cart-title-modify">
                <div class="wrapper-card">
                    <h3 class="text-left w-100">Используемые иконки</h3>
                </div>
            </v-card-title>
            <div class="icon-image-container">
                <input type="file" multiple class="d-none" ref="icon"
                       @change="changeUserIcon()">
                <v-btn
                        color="blue-grey"
                        class="white--text ml-3 mt-2"
                        @click="emitClickOnIcon">
                    Загрузить
                    <v-icon right dark>cloud_upload</v-icon>
                </v-btn>
                <div class="list-icons ml-3 mt-3">
                    <div class="img-cont ml-4" v-for="(icon, index) in images" :key="index+'icon_slayer'">
                        <img :src="icon.url" :alt="icon.url" class="object-fit-cover">
                        <v-icon class="ml-2 remove-icon" color="pink" @click="removeImage(icon.id, index, true)">
                            remove_circle_outline
                        </v-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-container height-table-options">
            <v-btn color="#7460ee" class="add-button" round @click="addNewReview">Добавить отзыв</v-btn>
            <v-data-table class="table-custom"
                          :headers="headers"
                          hide-actions
                          :items="reviews"
                          :loading="active">
                <v-progress-linear slot="progress" color="info" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="props">
                    <tr @click.stop="getSelectedReview(props.item.id)" style="cursor: pointer" v-if="!active">
                        <td class="text-xs-center">{{(props.index+1) + (page-1) * per_page}}</td>
                        <td class="text-xs-center">
                            <v-avatar v-if="props.item.avatar_id"
                                      :size="130"
                                      color="grey lighten-4"
                                      class="mt-2 mb-2"
                            >
                                <img :src="props.item.avatar.url" alt="avatar" class="object-fit-cover">
                            </v-avatar>
                        </td>
                        <td class="text-xs-left">{{props.item.name}}</td>
                        <td class="text-xs-left">{{humanityTimeView(props.item.date)}}</td>
                        <td class="text-xs-left"><p class="limiter-p-reworker">{{props.item.body | limiter(400)}}</p>
                        </td>
                        <td class="text-xs-center">
                            <!--{{props.item.rating}}-->
                            <v-icon :color="index+1 <= props.item.rating ? 'yellow': ''" size="15"
                                    class="rating-star"
                                    v-for="(star, index) in 5"
                                    :key="index">star_rate
                            </v-icon>
                        </td>
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
            <div class="text-xs-center" v-if="reviews.length" v-show="!active">
                <v-pagination color="#4db6ac!important"
                              v-model="page"
                              @click="getAllReview"
                              :length="pagesSize"
                              :total-visible="7"
                              circle
                ></v-pagination>
            </div>
            <v-dialog v-model="dialog"
                      :persistent="action === 'edit'"
                      lazy
                      width="60%">
                <v-card class=" modal-general-background">
                    <v-card-title class="headline teal lighten-3 white">
                        <v-btn icon dark @click="closeByCross"
                               :disabled="action === 'edit' ? checkEmptyFillingRequireFields : false" class="mb-3">
                            <v-icon class="w-auto h-auto">close</v-icon>
                        </v-btn>
                        <h3 class="white-color-text">{{action === 'edit' ? 'Просмотр и редактирование' :
                            'Добавление нового отзыва'}}</h3>
                        <v-spacer></v-spacer>
                        <div :title="checkEmptyFillingRequireFields ? 'Заполните обязательные поля': ''">
                            <v-btn :disabled="checkEmptyFillingRequireFields"
                                   color="#7460ee" class="add-button" round
                                   @click="actionBySaveButton">Сохранить
                            </v-btn>
                        </div>
                    </v-card-title>
                    <div class="p-3">
                        <h3 class="text-center">Основные данные</h3>
                        <p class="font-weight-bold text-xs-center w-100" style="color: darkred"
                           v-if="checkEmptyFillingRequireFields">Все поля данной формы, кроме ссылки,
                            являются обязательными
                        </p>
                        <div class="d-flex justify-content-around mt-2">
                            <v-text-field class="mr-2"
                                          label="Имя"
                                          placeholder="Введите имя"
                                          outline
                                          v-model="modalReview.name"
                            ></v-text-field>
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
                                        class="mt-2"
                                        slot="activator"
                                        :value="humanityTimeView(modalReview.date)"
                                        label="Выберите дату"
                                        prepend-icon="event"
                                        readonly
                                ></v-text-field>
                                <v-date-picker v-model="modalReview.date"
                                               locale="ru"
                                               @input="picker = false"></v-date-picker>
                            </v-menu>
                        </div>
                        <v-textarea
                                name="desc"
                                label="Введите отзыв"
                                outline
                                hint="отзыв"
                                v-model="modalReview.body"
                        ></v-textarea>
                        <div class="d-inline-flex">
                            <h4>Рейтинг:</h4>
                            <v-icon size="15"
                                    class="rating-star"
                                    @click="modalReview.rating  = index + 1"
                                    :style="{color: index <= modalReview.rating -1  ? 'yellow' : ''}"
                                    v-for="(star, index) in 5"
                                    :key="index">star_rate
                            </v-icon>
                        </div>
                        <v-text-field class="mr-2"
                                      label="Ссылка"
                                      placeholder="Введите ссылку"
                                      outline
                                      v-model="modalReview.link"
                        ></v-text-field>
                        <h3 class="text-center mt-3">Выберите иконку источника</h3>
                        <div class="list-icons ml-3 mt-3">
                            <div class="img-cont" v-for="(icon, index) in images" :key="index+'icon_slayer'"
                                 @click="setIconId(icon.id)">
                                <v-icon class="check-icon" color="rgba(0, 255,0, .7)"
                                        v-if="modalReview.icon_id === icon.id">check_circle
                                </v-icon>
                                <img :src="icon.url" :alt="icon.url">
                            </div>
                        </div>
                        <h3 class="text-center mt-3">Фото профиля</h3>
                        <v-btn
                                id="pick-avatar"
                                color="blue-grey"
                                class="white--text ml-3">
                            {{action && modalReview.avatar_id.url? 'Обновить' : 'Загрузить'}}
                            <v-icon v-if="modalReview.avatar_id.url" right dark>update</v-icon>
                            <v-icon v-else right dark>cloud_upload</v-icon>
                        </v-btn>
                        <!--<v-icon color="pink" class="remove-minus-icon"-->
                        <!--@click="removeImage(modalReview.main_image_id, null, true)">-->
                        <!--remove_circle_outline-->
                        <!--</v-icon>-->
                        <!--<v-avatar-->
                        <!--:size="130"-->
                        <!--color="grey lighten-4"-->
                        <!--class="avatar-field"-->
                        <!--@click="emitProfilePhotoLoading">-->
                        <!--<img :src="modalReview.avatar_id.url ? modalReview.avatar_id.url : 'images/gray-replacer.png'"-->
                        <!--alt="avatar" class="object-fit-cover">-->
                        <!--<v-icon color="pink" class="remove-minus-icon"-->
                        <!--@click.stop="removeImage(modalReview.avatar_id.id)">-->
                        <!--remove_circle_outline-->
                        <!--</v-icon>-->
                        <!--</v-avatar>-->
                        <div class="images mt-3" v-if="modalReview.avatar_id.url.length > 0">
                            <div class="avatar">
                                <img :src="modalReview.avatar_id.url" alt=""/>
                                <v-icon color="pink" class="remove-minus-icon"
                                        @click="removeImage(modalReview.avatar_id.id, null, false)">
                                    remove_circle_outline
                                </v-icon>
                            </div>
                        </div>
                        <avatar-cropper
                                v-if="trigger"
                                :labels="labels"
                                trigger="#pick-avatar"
                                upload-url="/api/v1/images"
                                :output-options="options"
                                :upload-headers="auth"
                                output-mime="image/png"
                                upload-form-name="images[]"
                                @completed="handleCompleted"/>
                        <!--<v-btn-->
                        <!--color="blue-grey"-->
                        <!--class="white&#45;&#45;text ml-3"-->
                        <!--@click="emitProfilePhotoLoading">-->
                        <!--Загрузить-->
                        <!--<v-icon right dark>cloud_upload</v-icon>-->
                        <!--</v-btn>-->
                        <!--<input type="file" class="d-none" ref="mainUserImage" @change="changeUserProfilePhoto()">-->
                        <h3 class="text-center mt-2">Фото с отдыха</h3>
                        <input v-if="trigger_image" type="file" multiple class="d-none" ref="photoFromVacation"
                               @change="changeVacationImages()">
                        <v-btn :disabled="modalReview.relations.images.length >= 9"
                               color="blue-grey"
                               class="white--text ml-3"
                               @click="emitVacationPhotoLoading">
                            Загрузить
                            <v-icon right dark>cloud_upload</v-icon>
                        </v-btn>
                        <span v-if="modalReview.relations.images.length >= 9" style="color: red"
                              class="font-weight-bold">Максимальное число изображений: 9</span>
                        <div class="images" v-if="modalReview.relations.images.length">
                            <div class="img-container mr-3" v-for="(img, index) in modalReview.relations.images"
                                 :key="index">
                                <img :src="img.url" alt="Фото">
                                <v-icon color="pink" class="remove-minus-icon" @click="removeImage(img.id, index)">
                                    remove_circle_outline
                                </v-icon>
                            </div>
                        </div>
                    </div>
                </v-card>
            </v-dialog>
            <DeleteModal v-bind="{deleteModal, objectOnDelete}" :deleteObject="deleteReviews"
                         @emitOnCancel="emitOnCancel"/>
        </div>
    </div>
</template>

<script>
    import {cloneDeep} from 'lodash'
    import moment from 'moment'
    import AvatarCropper from "vue-avatar-cropper";
    import DeleteModal from "./DeleteModal";

    let empty_copy = {}
    export default {
        slug: 'CommentsData',
        components: {DeleteModal, AvatarCropper},
        data() {
            let humanity_date = moment().format('YYYY-MM-DD')
            return {
                trigger_image: true,
                objectOnDelete: {
                    id: '',
                    index: ''
                },
                deleteModal: false,
                icon: [],
                trigger: false,
                auth: {
                    Authorization: `Bearer ${this.$store.state.user.access_token}`
                },
                options: {
                    width: 100,
                    height: 100
                },
                labels: {
                    submit: "Ок",
                    cancel: "Отмена"
                },
                userAvatar: undefined,
                active: false,
                page: 1,
                pagesSize: null,
                per_page: 5,
                dialog: false,
                picker: false,
                headers: [
                    {
                        text: '#',
                        align: 'center',
                        value: 'sharp',
                        sortable: false,
                        width: 56
                    },
                    {
                        text: 'Аватар',
                        align: 'center',
                        value: 'avatar',
                        width: 155,
                        sortable: false
                    },
                    {
                        text: 'Имя',
                        align: 'left',
                        width: 220,
                        value: 'name',
                        sortable: false
                    },

                    {
                        text: 'Дата',
                        align: 'left',
                        value: 'date',
                        width: 160,
                        sortable: false
                    },
                    {
                        text: 'Отзыв',
                        align: 'left',
                        value: 'review',
                        sortable: false
                    },
                    {
                        text: 'Рейтинг',
                        align: 'center',
                        value: 'rating',
                        width: 300,
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
                reviews: [],
                modalReview: {
                    "avatar_id": {
                        "url": ''
                    },
                    "name": "",
                    "date": humanity_date,
                    "body": "",
                    "rating": 1,
                    "relations": {
                        "images": []
                    },
                    "icon_id": null,
                    "icon": {
                        "id": '',
                        "url": ''
                    }
                },
                profilePhoto: {},
                photoFromVacation: [],
                iconsArray: [],
                action: '',
                globalEditId: null,
                images: []
            }
        },
        watch: {
            page() {
                this.getAllReview(['avatar'])
            },
            dialog(n) {
                if (!n) {
                    this.trigger = false
                }
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
            setIconId(id) {
                if (this.modalReview.icon_id === id) {
                    this.modalReview.icon_id = null
                } else {
                    this.modalReview.icon_id = id
                }
            },
            getImages() {
                this.$axios.get('images/', {
                    params: {
                        'filter[type]': 'icon'
                    }
                })
                    .then(res => {
                        this.images = res.data
                        // this.reviews.forEach((el, index, object) => {
                        //     let idx = this.images.findIndex(_ => _.id === el.icon_id)
                        //     console.log(idx)
                        //     if (idx !== null && idx !== -1) {
                        //         object[index].icon.id = this.images[idx].id
                        //         object[index].icon.url = this.images[idx].url
                        //     }
                        // })
                    })
            },
            handleCompleted(response) {
                this.modalReview.avatar_id = response[0]
            },
            deleteReviews(id, index) {
                this.$axios.delete(`reviews/${id}`)
                    .then(() => {
                        this.reviews.splice(index, 1)
                        if (this.reviews.length > 0) {
                            this.getAllReview(['avatar'])
                        } else {
                            this.page--;
                        }
                        this.getAllReview(['avatar'])
                        this.deleteModal = false
                    })
            },
            closeByCross() {
                this.modalReview = cloneDeep(empty_copy)
                this.dialog = false
            },
            getSelectedReview(id) {
                this.action = 'edit'
                this.globalEditId = id
                this.$axios.get(`reviews/${id}`, {
                    params: {
                        with: ['avatar', 'images']
                    }
                })
                    .then(res => {
                        let front_copy = cloneDeep(res.data)
                        front_copy.relations = {
                            images: res.data.images
                        }
                        // delete front_copy.images
                        front_copy.avatar_id = front_copy.avatar
                        let {avatar, images, ...transofrm} = front_copy // remove avatar and images like redundant
                        this.modalReview = transofrm
                        this.modalReview.avatar_id = this.modalReview.avatar_id ? this.modalReview.avatar_id : {
                            created_at: '',
                            id: '',
                            type: '',
                            updated_at: '',
                            url: ''
                        }
                        this.dialog = true
                        this.trigger = true
                    })
            },
            addNewReview() {
                this.action = 'add'
                this.modalReview = cloneDeep(empty_copy)
                this.dialog = true
                this.trigger = true
            },
            emitProfilePhotoLoading() {
                this.$refs['mainUserImage'].click()
            },
            changeUserIcon() {
                this.iconsArray = this.$refs['icon'].files
                this.uploadImages('icon', this.iconsArray)
            },
            emitClickOnIcon() {
                this.$refs['icon'].click()
            },
            emitVacationPhotoLoading() {
                this.$refs['photoFromVacation'].click()
            },
            changeVacationImages() {
                this.photoFromVacation = this.$refs['photoFromVacation'].files
                this.uploadImages('any', this.photoFromVacation)
            },
            changeUserProfilePhoto() {
                this.profilePhoto = this.$refs['mainUserImage'].files
                this.uploadImages('profile', this.profilePhoto)
            },
            uploadImages(clarify, image_array) {
                this.trigger_image = false
                let formData = new FormData()
                for (let i = 0; i <= image_array.length - 1; i++) {
                    formData.append('images[]', image_array[i])
                }
                formData.set('height', clarify === 'icon' ? '50' : (clarify === 'profile' ? '1920' : '1024'))
                formData.set('width', clarify === 'icon' ? '50' : (clarify === 'profile' ? '1920' : '1024'))
                formData.set('type', clarify === 'icon' ? clarify : 'unknown')
                this.$axios.post('images', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(res => {
                        switch (clarify) {
                            case 'profile':
                                this.modalReview.avatar_id = res.data[0]
                                break
                            case 'icon':
                                this.images = this.images.concat(res.data)
                                break
                            default:
                                this.modalReview.relations.images = this.limiterImagesCounterToRequire(this.modalReview.relations.images.concat(res.data), 9)
                                break
                        }
                        this.trigger_image = true
                    })
            },
            removeImage(id, index = null, icon = false) {
                this.$axios.delete(`images/${id}`)
                    .then(() => {
                        if (icon) {
                            this.images.splice(index, 1)
                        } else if (index !== null) {
                            this.modalReview.relations.images.splice(index, 1)
                        } else {
                            this.modalReview.avatar_id = {
                                created_at: '',
                                id: '',
                                type: '',
                                updated_at: '',
                                url: ''
                            }
                        }
                    })
            },
            actionBySaveButton() {
                let render_copy = cloneDeep(this.modalReview)
                render_copy.avatar_id = render_copy.avatar_id.id
                render_copy.relations.images = render_copy.relations.images.map(_ => _.id)
                if (this.action === 'add') {
                    this.$axios.post('reviews', render_copy)
                        .then(res => {
                            if (this.page === 1) {
                                if (this.reviews.length < this.per_page) {
                                    this.reviews.unshift(res.data)
                                } else {
                                    this.getAllReview(['avatar'])
                                }
                            } else {
                                this.getAllReview(['avatar'])
                            }
                            this.action = ''
                            this.dialog = false
                        })
                } else {
                    this.$axios.put(`reviews/${this.globalEditId}`, render_copy)
                        .then(res => {
                            this.reviews.splice(this.reviews.findIndex(e => e.id === this.globalEditId), 1, res.data)
                            this.action = ''
                            this.dialog = false
                        })
                }
                //post

            },
            getAllReview(params) {
                this.active = true
                this.$axios.get('reviews', {
                    params: {
                        with: params,
                        paginate: true,
                        page: this.page,
                        per_page: this.per_page
                    }
                })
                    .then(res => {
                        this.pagesSize = res.data.last_page
                        this.reviews = res.data.data
                        this.active = false
                    })
            },
        },
        computed: {
            checkEmptyFillingRequireFields() {
                let {avatar_id, relations, link, icon, icon_id, ...stringFields} = this.modalReview
                return Object.values(stringFields).some(e => e === '' || e === null) || !this.modalReview.relations.images.length || !this.modalReview.avatar_id.url
            }
        },
        created() {
            empty_copy = cloneDeep(this.modalReview)
            this.getAllReview(['avatar'])
            let place = localStorage.getItem('last_admin_creator')
            if (place !== this.$options.slug) {
                localStorage.setItem('last_admin_creator', this.$options.slug)
            }
            this.getImages()
        }
    }
</script>
<style scoped lang="scss">
    .rating-star {
        width: 15px;
        height: 15px;
        margin: 0 3px;
        cursor: pointer;
    }

    .vue-avatar-cropper-demo {
        max-width: 18em;
        margin: 0 auto;
    }

    .avatar {
        width: 160px;
        border-radius: 6px;
        display: block;
        margin: 20px auto;
    }

    .card-img-overlay {
        display: none;
        transition: all 0.5s;
    }

    .card-img-overlay button {
        margin-top: 20vh;
    }

    .card:hover .card-img-overlay {
        display: block;
    }

    .list-icons {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        width: 100%;
        height: auto;
        padding-bottom: 10px;

        .img-cont {
            height: 50px;
            width: 50px;
            display: flex;
            margin-right: 20px;
            margin-top: 10px;
            position: relative;
            z-index: 10;

            &:hover .remove-icon {
                display: block;
            }

            .check-icon {
                position: absolute;
            }

            .remove-icon {
                display: none;
                position: absolute;
                top: -23px;
                right: -19px;
                margin: 0 !important;
            }

            img {
                margin: auto;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }

    }
</style>
