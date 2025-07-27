import { createRouter, createWebHistory } from 'vue-router'
import register from '@/pages/register.vue'
import login from '@/pages/login.vue'
import index from '@/pages/index.vue'
import shop from '@/pages/shop.vue'
import classify from '@/pages/classify.vue'
import addProduct from '@/pages/addProduct.vue'
import carbon from '@/pages/carbon.vue'
import detail from '@/pages/detail.vue'
import shopCar from '@/pages/shopCar.vue'
import info from '@/pages/info.vue'
import search from '@/pages/search.vue'
import news from '@/pages/news.vue'
import orders from '@/pages/orders.vue'
import address from '@/pages/address.vue'
import addAddress from '@/pages/addAddress.vue'
import { useUserStore } from '@/stores/user'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path:'',
      component:index,
      alias:'/index'
    },
    {
      path:'/register',
      component:register
    }
    ,
    {
      path:'/login',
      component:login
    },
    {
      path:'/info',
      component:info
    },
    {
      path:'/classify',
      redirect: () => {
      return { name: 'shop', params: { classProduct: 'all' } };
    },
      component:classify,

      children:[
        {
          path:'/shop/:classProduct',
          name:'shop',
          component:shop
        }
      ]
    },
    {
      path:'/add',
      component:addProduct,
      meta: { requiresAuth: true },
      beforeEnter: (to, from, next) => {
        const userStore = useUserStore();
        if (!userStore.isLoggedIn) {
          alert('请先登录后再发布商品！');
          return next('/login');
        }
        next();
      },
    },
    {
      path:'/detail/:proId',
      name:'detail',
      component:detail
    },
    {
      path:'/shopCar',
      meta: { requiresAuth: true },
      component:shopCar
    },
    {
      path:'/orders',
      name:'orders',
      component:orders,
      meta:{ requiresAuth: true },
    },
    {
      path:'/address',
      name:'address',
      component:address
    },
    {
      path:'/addAddress',
      name:'addAddress',
      component:addAddress
    },
    {
      path:'/carbon',
      component:carbon

    },
    {
      path:'/search',
      component:search
    },
    {
      path:'/news',
      component:news
    },
  ],
})
router.beforeEach((to,from,next)=>{
  const userStore=useUserStore()
  
   if(to.meta.requiresAuth){
        if (!userStore.isLoggedIn) {
            alert("请登录后查看")
            next('/login')
        }
        else
            next()
    }
    else
        next()
})
export default router