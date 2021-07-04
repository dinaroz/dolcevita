<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Task</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" v-model="task.title">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="task.description">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select required class="form-select" aria-label="Default select example" v-model="task.status">
                                        <option value="done">done</option>
                                        <option value="new">new</option>
                                        <option value="panding">panding</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Destination date</label>
                                    <input required type="date" class="form-control" v-model="task.destination_date">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
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
    name: "Add",
    data(){
        return {
            task:{
                title:"",
                description:"",
                status:"",
                destination_date:""

            }
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/task',this.task).then(response=>{
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
