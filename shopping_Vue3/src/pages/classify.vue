<template>
    <section class="category-section">
        <div class="category-card">
            <h2>电子</h2>
            <ul>
                <li>
                    <a href="#">手机</a>
                </li>
                <li><a href="#">电脑</a></li>
                <li><a href="#">影音数码</a></li>
                <li><a href="#">智能设备</a></li>
                <li><a href="#">摄影摄像</a></li>
                <li><a href="#">办公设备</a></li>
                <li><a href="#">网络设备</a></li>
            </ul>
        </div>
        <div class="category-card">
            <h2>服饰与鞋包</h2>
            <ul>
                <li><a href="#">女装</a></li>
                <li><a href="#">女鞋</a></li>
                <li><a href="#">男装</a></li>
                <li><a href="#">男鞋</a></li>
                <li><a href="#">内衣</a></li>
                <li><a href="#">箱包手表</a></li>
                <li><a href="#">手势配饰</a></li>
            </ul>
        </div>
        <div class="category-card">
            <h2>家具家电</h2>
            <ul>
                <li><a href="#">住宅家具</a></li>
                <li><a href="#">办公家具</a></li>
                <li><a href="#">生活电器</a></li>
                <li><a href="#">厨房电器</a></li>
                <li><a href="#">卫浴</a></li>
            </ul>
        </div>
        <div class="category-card">
            <h2>车辆及租房</h2>
            <ul>
                <li><a href="#">汽车整车</a></li>
                <li><a href="#">摩托车</a></li>
                <li><a href="#">电动车</a></li>
                <li><a href="#">自行车</a></li>
                <li><a href="#">车辆配件</a></li>
                <li><a href="#">租房/房产</a></li>
            </ul>
        </div>
        <div class="category-card">
            <h2>五金及农牧</h2>
            <ul>
                <li><a href="#">电子元器件</a></li>
                <li><a href="#">电子电工</a></li>
                <li><a href="#">五金工具</a></li>
                <li><a href="#">农用物资</a></li>
                <li><a href="#">农机农具</a></li>
            </ul>
        </div>
    </section>

    <div class="commender">
        <ul>
            <li>
                <RouterLink :to="{
                    name:'shop',
                    params:{
                        classProduct:'all'
                    }
                }">全部</RouterLink>
            </li>
            <li>
                <RouterLink :to="{
                    name: 'shop',
                    params: {
                        classProduct: '电子产品'
                    }
                }">电子</RouterLink>
            </li>
            <li>
                <RouterLink :to="{
                    name: 'shop',
                    params: {
                        classProduct: '服饰'
                    }
                }">服饰</RouterLink>
            </li>
            <li>
                <RouterLink :to="{
                    name: 'shop',
                    params: {
                        classProduct: '家具家电'
                    }
                }">家具家电</RouterLink>
            </li>
            <li>
                <RouterLink :to="{
                    name: 'shop',
                    params: {
                        classProduct: '车辆'
                    }
                }">车辆</RouterLink>
            </li>
            <li>
                <RouterLink :to="{
                    name: 'shop',
                    params: {
                        classProduct: '五金工具'
                    }
                }">五金</RouterLink>
            </li>
            <li>
                <RouterLink :to="{
                    name: 'shop',
                    params: {
                        classProduct: '环保商品'
                    }
                }">环保商品</RouterLink>
            </li>
            <li>
                <RouterLink :to="{
                    name: 'shop',
                    params: {
                        classProduct: '其他'
                    }
                }">其他</RouterLink>
            </li>
        </ul>
    </div>

    <div class="content">
        <RouterView></RouterView>
    </div>
</template>
<script lang="ts" setup>
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
const route=useRoute()
onMounted(() => {
    window.scrollTo(0, 0);
});
</script>
<style scoped>
.category-section {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
    margin-bottom: 40px;
}

.category-card {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
}

.category-card h2 {
    font-size: 22px;
    margin-bottom: 15px;
}

.category-card ul {
    list-style-type: none;
    padding: 0;
}

.category-card li {
    margin: 10px 0;
}

.category-card a {
    text-decoration: none;
    color: #333;
}

.category-card a:hover {
    color: #ff6f00;
}

/* 推荐 */
.commender {
    width: 100%;
    padding: 0px 0px;
    background-color: #fff;
}

.commender ul {
    display: flex;
    padding-inline-start: 0;
    flex-wrap: wrap;
    justify-content: space-around;
    width: 100%;
    box-shadow: 0 6px 5px rgba(0, 0, 0, 0.1);
}

.commender li {
    padding: 11px;
}

.commender a {
    color: #ff6f00;
    font-size: 18px;
    font-weight: 600;

}
</style>