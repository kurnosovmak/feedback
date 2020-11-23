<template>
    <div class="card" style="width: 500px;margin: 100px auto;">
        <div class="card-header">
            Форма обратной связи
        </div>
        <div class="card-body">
            <div v-if="loading" >Отправляется</div>
            <form v-else @submit.prevent="onSubmit()">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input required type="text" class="form-control" v-model="name" aria-describedby="nameHelp" id="name" name="name" placeholder="Имя">
                    <small id="nameHelp" class="form-text text-muted">{{nameM}}</small>
                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input required type="text" class="form-control" id="phone" v-model="phone"  aria-describedby="phoneHelp" name="phone" placeholder="Телефон">
                    <small id="phoneHelp" class="form-text text-muted">{{phoneM}}</small>
                </div>

                <div class="form-group">
                    <label for="message">Сообщение</label>
                    <textarea required class="form-control" id="message" name="message"  v-model="message" aria-describedby="messageHelp" placeholder="Сообщение" aria-label="With textarea"></textarea>
                    <small id="messageHelp" class="form-text text-muted">{{messageM}}</small>
                </div>

                <button class="btn btn-primary" style="width: 100%;" type="submit" >Отправить</button>
            </form>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                name:'',
                phone:'',
                message:'',
                nameM:'',
                phoneM:'',
                messageM:'',
                loading: false
            }
        },
        methods:{
            onSubmit(){
                this.loading = true;
                axios
                    .request({
                        url: '/api/feedback',
                        method: 'post',
                        baseURL: 'http://127.0.0.1:8000',
                        data: {
                            "name": this.name.toString(),
                            "phone": this.phone.toString(),
                            "message": this.message.toString()
                        }
                    })
                    .then(response => {
                        var info =response.data.status;

                        if(info == '200'){

                            this.$router.push({ name: 'feedback.success'});
                            this.loading = false;
                        }else if(info == '401'){
                            if(response.data.error.name){
                                this.nameM = 'Имя не должно быть пустым';
                            }

                            if(response.data.error.phone){
                                this.phoneM = 'Телефон не должен быть пустым и должен состоять из чисел  длинной не менее 10 символов';
                            }

                            if(response.data.error.message){
                                this.messageM = 'Сообщение не должно быть пустым';
                            }

                            this.loading = false;
                        }


                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        }
    }
</script>
