<template>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <RouterLink to="/index" class="navbar-brand">
            <img src="../../image/logo.png" alt="">

        </RouterLink>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navtop">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navtop">
            <ul class="navbar-nav ulLeft">
                <li class="nav-item">
                    <RouterLink to="/classify" class="nav-link bolder">二手市场</RouterLink>
                </li>
                <li class="nav-item">
                    <RouterLink to="/add" class="nav-link bolder">发布商品</RouterLink>
                </li>

            </ul>
        </div>
        <ul class="navbar-nav ulRight">
            <li class="nav-item">
                <a href="javascript:;" class="nav-link all" @click="open">所有商品分类及服务 ⌵</a>
                <div class="allHide" :class="changeDis">
                    <dl>
                        <dt>电子</dt>
                        <dd><a href="javascript:;">手机</a></dd>
                        <dd><a href="javascript:;">电脑</a></dd>
                        <dd><a href="javascript:;">影音数码</a></dd>
                        <dd><a href="javascript:;">智能设备</a></dd>
                        <dd><a href="javascript:;">摄影摄像</a></dd>
                        <dd><a href="javascript:;">办公设备</a></dd>
                        <dd><a href="javascript:;">网络设备</a></dd>
                    </dl>
                    <dl>
                        <dt>服饰与鞋包</dt>
                        <dd><a href="javascript:;">女装</a></dd>
                        <dd><a href="javascript:;">女鞋</a></dd>
                        <dd><a href="javascript:;">男装</a></dd>
                        <dd><a href="javascript:;">男鞋</a></dd>
                        <dd><a href="javascript:;">内衣</a></dd>
                        <dd><a href="javascript:;">箱包手表</a></dd>
                        <dd><a href="javascript:;">手势配饰</a></dd>
                    </dl>
                    <dl>
                        <dt>家具家电</dt>
                        <dd><a href="javascript:;">住宅家具</a></dd>
                        <dd><a href="javascript:;">办公家具</a></dd>
                        <dd><a href="javascript:;">生活电器</a></dd>
                        <dd><a href="javascript:;">厨房电器</a></dd>
                        <dd><a href="javascript:;">卫浴</a></dd>

                    </dl>
                    <dl>
                        <dt>车辆及租房</dt>
                        <dd><a href="javascript:;">汽车整车</a></dd>
                        <dd><a href="javascript:;">摩托车</a></dd>
                        <dd><a href="javascript:;">电动车</a></dd>
                        <dd><a href="javascript:;">自行车</a></dd>
                        <dd><a href="javascript:;">车辆配件</a></dd>
                        <dd><a href="javascript:;">租房/房产</a></dd>
                    </dl>
                    <dl>
                        <dt>五金及农牧</dt>
                        <dd><a href="javascript:;">电子元器件</a></dd>
                        <dd><a href="javascript:;">电子电工</a></dd>
                        <dd><a href="javascript:;">五金工具</a></dd>
                        <dd><a href="javascript:;">农用物资</a></dd>
                        <dd><a href="javascript:;">农机农具</a></dd>
                    </dl>
                    <dl>
                        <dt>其他</dt>
                        <dd><a href="javascript:;">碳排放计算</a></dd>
                        <dd><a href="javascript:;">新闻</a></dd>
                    </dl>
                    <div class="map">查看碳排放 ></div>
                </div>

            </li>
            <li class="nav-item searchLi">
                <RouterLink to="/search" class="nav-link search"><span class="searchContent">搜索</span><span
                        class="iconfont icon-search"></span></RouterLink>
            </li>
            <li class="nav-item">
                <RouterLink  to="/shopCar" class="nav-link"><span class="shoppingContent">购物车</span><span
                        class="iconfont icon-cart"></span></RouterLink>
            </li>
            <li class="nav-item">
                <RouterLink :to="{path:toPath}" class="nav-link">
                    <RouterLink :to="{ path: '/login' }" class="signUpContent" v-if="!userStore.isLoggedIn">登录</RouterLink><img
                        src="../../image/登录.png" v-if="!userStore.isLoggedIn" alt="">
                    <span v-else class="userName">{{ userStore.userName }}</span>
                </RouterLink>

            </li>
        </ul>
    </nav>
    <div class="content">
        <RouterView></RouterView>
    </div>
</template>
<script lang="ts" setup>
import { computed, reactive } from 'vue';
import { RouterLink } from 'vue-router';
import { useUserStore } from '@/stores/user';
const userStore=useUserStore()
let changeDis=reactive(
    {
        Disflex: false,
        Disnone: true
    }
)
let toPath=computed(()=>{
    if (userStore.isLoggedIn) return '/info'
    else return '/login'
});

function open(){
    changeDis.Disflex = !changeDis.Disflex
    changeDis.Disnone = !changeDis.Disnone
}
</script>
<style scoped>
    @import url(../../css/bootstrap.min.css);
    @import url(../../css/nav.css);
    @import url(../../icomoon/style.css);
    .Disflex{
        display: flex;
    }
    .Disnone{
        display: none;
    }
    .content{
        margin-top: 90px;
    }
    .userName{
        border: 1px solid black;
        padding-left: 5px;
    }
</style>