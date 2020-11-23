import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

import FeedbackFormComponent from "./components/FeedbackFormComponent";
import SuccessFeedback from "./components/SuccessFeedback";

const routes = [
    {
        path:'/',
        name:'index',
        component: FeedbackFormComponent
    },
    {
        path:'/feedback/success',
        name: 'feedback.success',
        component: SuccessFeedback
    },

];

export default new VueRouter({
    mode:'history',
    routes
});
