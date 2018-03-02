// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import MyMask from '@/components/common/Mask'
import FormField from '@/components/common/FormField'

export default function () {
  // 注册全局组件
  Vue.component('my-mask', MyMask);
  Vue.component('form-filed', FormField);
}
