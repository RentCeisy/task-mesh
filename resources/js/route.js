import VueRouter from 'vue-router';
import index from './components/Index'
import editProduct from './components/EditProduct'

export default new VueRouter({
    routes: [
        {
            path: '/',
            component: index
        },
        {
            path: '/product/edit/:id',
            component: editProduct,
            props: true
        },
    ],
    mode: 'history'
})
