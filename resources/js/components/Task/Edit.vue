<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Task</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
<!--                            <div class="col-12 mb-2">-->
<!--                                <div class="form-group">-->
<!--                                    <label>Title</label>-->
<!--                                    <input type="text" class="form-control" v-model="task.title">-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="task.description">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-select" aria-label="Default select example" v-model="task.status">
                                        <option value="done">done</option>
                                        <option value="new">new</option>
                                        <option value="panding">panding</option>
                                    </select>
                                </div>
                            </div>
<!--                            <div class="col-12 mb-2">-->
<!--                                <div class="form-group">-->
<!--                                    <label>Destination date</label>-->
<!--                                    <input type="date" class="form-control" v-model="task.destination_date">-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Edit",
    data(){
        return {
            task:{
                // title:"",
                description:"",
                // destination_date:"",
                status:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showCategory()
    },
    methods:{
        async showCategory(){
            await this.axios.get(`/api/task/${this.$route.params.id}`).then(response=>{
                const { title, description, status, destination_date } = response.data
                this.task.title = title
                this.task.description = description
                this.task.status = status
                this.task.destination_date = destination_date
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post(`/api/task/${this.$route.params.id}`,this.task).then(response=>{
                this.$router.push({name:"home"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }

}
</script>

<style scoped>

</style>
