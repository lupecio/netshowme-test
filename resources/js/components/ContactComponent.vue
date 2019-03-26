<template>
    <div class="container">
        <div class="row>">
            <div class="col-4 m-auto">
                <h1>Contato</h1>
                <form>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" v-model="contact.name" class="form-control" id="name" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" v-model="contact.email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" v-model="contact.phone" class="form-control" id="phone" placeholder="Telefone">
                    </div>
                    <div class="form-group">
                        <label for="message">Mensagem</label>
                        <textarea v-model="contact.message" class="form-control" id="message"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Arquivo Anexo</label>
                        <input type="file" @change="handleFileUpload" ref="file" class="form-control-file" id="file">
                    </div>
                    <button @click.prevent="sendContact" type="submit" class="btn btn-success">Enviar</button>
                </form>
                <div v-if="message" class="alert alert-success mt-3" role="alert">
                    {{ message }}
                </div>
                <div v-if="errors" v-for="error in errors" class="alert alert-danger mt-3" role="alert">
                    {{ error[0] }}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                contact: {
                    name: '',
                    email: '',
                    phone: '',
                    message: '',
                    file: ''
                },
                errors: null,
                message: null
            }
        },
        methods: {
            sendContact: function() {
                let formData = new FormData();
                formData.append('name', this.contact.name);
                formData.append('email', this.contact.email);
                formData.append('phone', this.contact.phone);
                formData.append('message', this.contact.message);
                formData.append('file', this.contact.file);

                let self = this

                axios.post('/api/contacts/', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (response) {
                    self.errors = null
                    self.message = response.data.message
                })
                .catch(function (error) {
                    self.message = null
                    self.errors = error.response.data.errors
                });
            },
            handleFileUpload() {
                this.contact.file = this.$refs.file.files[0];
            }
        }
    }
</script>
