import VueRouter from 'vue-router';
import index from './components/Index'
import editProduct from './components/EditProduct'
import editCategory from './components/EditCategory'

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
        {
            path: '/category/edit/:id',
            component: editCategory,
            props: true
        },
    ],
    mode: 'history'
})
