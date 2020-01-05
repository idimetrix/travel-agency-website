<template>
    <v-dialog v-model="deleteModal" persistent max-width="350">
        <v-card>
            <v-card-text>Вы действительно хотите удалить эту запись?
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue" flat @click="emitOnCancel">Отмена</v-btn>
                <v-btn color="blue" flat @click="deleteObject(objectOnDelete.id, objectOnDelete.index)">Ок
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props: ['deleteModal', 'objectOnDelete', 'deleteObject'],
        name: "DeleteModal",
        methods: {
            emitOnCancel() {
                this.$emit('emitOnCancel', false)
            },
        }
    }
</script>

<style scoped>

</style>