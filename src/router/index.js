import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/views/Home'
import Auth from '@/views/Auth'
import Login from '@/components/auth/Login'
import Regist from '@/components/auth/Regist'
import ServiceTerms from '@/components/auth/ServiceTerms'
import UserAgreement from '@/components/auth/UserAgreement'
import PasswordRetrieval from '@/components/auth/PasswordRetrieval'
import Bdc from '@/views/Bdc'
import BdcList from '@/components/bdc/List'
import Mine from '@/views/Mine'
import CloudCompute from '@/views/CloudCompute'
import ComputeShop from '@/components/compute/Shop'
import ComputeDetail from '@/components/compute/Detail'
import ComputeTransfer from '@/views/ComputeTransfer'
import TransferList from '@/components/transfer/List'
import TransferDetail from '@/components/transfer/Detail'
import User from '@/views/User'
import Message from '@/components/user/Message'
import Account from '@/components/user/Account'
import LpCenter from '@/components/user/LpCenter'
import ComputeProperty from '@/components/user/ComputeProperty'
import MoneyFlow from '@/components/user/MoneyFlow'
import VirtualCurrencyFlow from '@/components/user/VirtualCurrencyFlow'
import Password from '@/components/user/Password'
import Order from '@/components/user/Order'
import OrderDetail from '@/components/user/OrderDetail'
import AccountEvaluate from '@/components/user/AccountEvaluate'
import HelpSupport from '@/views/HelpSupport'
import AboutUs from '@/components/help/AboutUs'
import Issues from '@/components/help/Issues'
import SafeGuarantee from '@/components/help/SafeGuarantee'
import WebInfo from '@/views/WebInfo'
import Activity from '@/components/info/Activity'
import Notice from '@/components/info/Notice'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [{
    path: '*',
    name: 'notFound',
    component: Home
  }, {
    path: '/',
    name: 'home',
    component: Home
  }, {
    path: '/auth',
    component: Auth,
    children: [{
      path: 'login',
      name: 'login',
      component: Login
    }, {
      path: 'regist',
      name: 'regist',
      component: Regist
    }, {
      path: 'passwordRetrieval',
      name: 'passwordRetrieval',
      component: PasswordRetrieval
    }, {
      path: 'serviceTerms',
      name: 'serviceTerms',
      component: ServiceTerms
    }, {
      path: 'userAgreement',
      name: 'userAgreement',
      component: UserAgreement
    }]
  }, {
    path: '/bdc',
    component: Bdc,
    children: [{
      path: 'list',
      name: 'bdcList',
      component: BdcList
    }]
  }, {
    path: '/cloudCompute',
    component: CloudCompute,
    children: [{
      path: 'shop',
      name: 'computeShop',
      component: ComputeShop
    }, {
      path: 'detail/:id',
      name: 'computeDetail',
      component: ComputeDetail
    }]
  }, {
    path: '/computeTransfer',
    component: ComputeTransfer,
    children: [{
      path: 'list',
      name: 'transferList',
      component: TransferList
    }, {
      path: 'detail/:id',
      name: 'transferDetail',
      component: TransferDetail
    }]
  }, {
    path: '/user',
    component: User,
    beforeEnter: (to, from, next) => {
      var data = localStorage.getItem('info')
      if (!data) {
        next({ name: 'login' })
      } else {
        next()
      }
    },
    children: [{
      path: 'lpCenter',
      name: 'lpCenter',
      component: LpCenter
    }, {
      path: 'account',
      name: 'account',
      component: Account
    }, {
      path: 'computeProperty',
      name: 'computeProperty',
      component: ComputeProperty
    }, {
      path: 'moneyFlow',
      name: 'moneyFlow',
      component: MoneyFlow
    }, {
      path: 'virtualCurrencyFlow',
      name: 'virtualCurrencyFlow',
      component: VirtualCurrencyFlow
    }, {
      path: 'password',
      name: 'password',
      component: Password
    }, {
      path: 'order/:type/:status',
      name: 'order',
      component: Order
    }, {
      path: 'orderDetail/:id',
      name: 'orderDetail',
      component: OrderDetail
    }, {
      path: 'message',
      name: 'message',
      component: Message
    }]
  }, {
    path: '/accountEvaluate',
    name: 'accountEvaluate',
    component: AccountEvaluate
  }, {
    path: '/mine',
    component: Mine
  }, {
    path: '/helpSupport',
    component: HelpSupport,
    children: [{
      path: 'aboutUs',
      name: 'aboutUs',
      component: AboutUs
    }, {
      path: 'issues',
      name: 'issues',
      component: Issues
    }, {
      path: 'safeGuarantee',
      name: 'safeGuarantee',
      component: SafeGuarantee
    }]
  }, {
    path: '/webInfo',
    component: WebInfo,
    children: [{
      path: 'activity',
      name: 'activity',
      component: Activity
    }, {
      path: 'notice',
      name: 'notice',
      component: Notice
    }]
  }]
})
