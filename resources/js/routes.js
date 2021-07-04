const TaskList = () => import('./components/Task/List.vue' /* webpackChunkName: "resource/js/components/category/list" */)
const TaskCreate = () => import('./components/Task/Add.vue' /* webpackChunkName: "resource/js/components/category/add" */)
const TaskEdit = () => import('./components/Task/Edit.vue' /* webpackChunkName: "resource/js/components/category/edit" */)

export const routes = [
    {
        name: 'home',
        path: '/',
        component: TaskList
    },
    {
        name: 'taskEdit',
        path: '/task/:id/edit',
        component: TaskEdit
    },
    {
        name: 'taskAdd',
        path: '/task/add',
        component: TaskCreate
    }
]
