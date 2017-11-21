// components config
  import Vue from 'vue'
  import Router from 'vue-router'
  import Home from '@/views/Home'
  import NotFound from '@/views/NotFound'
  import Auth from '@/views/Auth'
  import Login from '@/components/auth/Login'
  import Regist from '@/components/auth/Regist'
  import PasswordRetrieval from '@/components/auth/PasswordRetrieval'
  import Bdc from '@/views/Bdc'
  import Mine from '@/views/Mine'
  import CloudCompute from '@/views/CloudCompute'
  import ComputeShop from '@/components/compute/Shop'
  import ComputeDetail from '@/components/compute/Detail'
  import Mining from '@/components/compute/mining'
  import Activity from '@/components/compute/activity'
  import Activitya from '@/components/compute/activitya'
  import ComputeTransfer from '@/views/ComputeTransfer'
  import TransferList from '@/components/transfer/List'
  import TransferDetail from '@/components/transfer/Detail'
  import User from '@/views/User'
  import Message from '@/components/user/Message'
  import MessageDetail from '@/components/user/MessageDetail'
  import Repayment from '@/components/user/Repayment'
  import RepaymentDetail from '@/components/user/RepaymentDetail'
  import Recharge from '@/components/user/Recharge'
  import Account from '@/components/user/Account'
  import LpCenter from '@/components/user/LpCenter'
  import ComputeProperty from '@/components/user/ComputeProperty'
  import IncomeChart from '@/components/user/IncomeChart'
  import MoneyFlow from '@/components/user/MoneyFlow'
  import VirtualCurrencyFlow from '@/components/user/VirtualCurrencyFlow'
  import Password from '@/components/user/Password'
  import Order from '@/components/user/Order'
  import OrderDetail from '@/components/user/OrderDetail'
  import Article from '@/views/Article'
  import AccountEvaluate from '@/components/user/AccountEvaluate'
  import WebInfo from '@/views/WebInfo'
  import AboutUs from '@/components/info/AboutUs'
  import Issues from '@/components/info/Issues'
  import WebInfoList from '@/components/info/List'
  import WebInfoDetail from '@/components/info/Detail'
  import IssuesDetail from '@/components/info/IssuesDetail'
// mobile
  import Mobile from '@/views/Mobile'
  import MIndex from '@/components/mobile/Mindex'
  import MbdcForm from '@/components/mobile/MbdcForm'
  import Mhelp from '@/components/mobile/Mhelp'
  import Mnews from '@/components/mobile/Mnews'
  import Mnotice from '@/components/mobile/Mnotice'
  import Mmessage from '@/components/mobile/Mmessage'
  import Mproperty from '@/components/mobile/Mproperty'
  import MmoneyFlow from '@/components/mobile/MmoneyFlow'
  import Minformation from '@/components/mobile/Minformation'
  import Madministration from '@/components/mobile/Madministration'
  import Mpersoncenter from '@/components/mobile/Mpersoncenter'
  import Maddress from '@/components/mobile/Maddress'
// use plugin
  Vue.use(Router)
// export
  export default new Router({
    mode: 'history',
    routes: [{
      path: '*',
      name: 'notFound',
      component: NotFound
    }, {
      path: '/',
      name: 'home',
      component: Home,
      beforeEnter: (to, from, next) => {
        document.querySelector('title').innerHTML = '算力网'
        document.title = to.meta.title || '算力网'
        document.querySelector('meta[name="keywords"]').setAttribute('content', '算力网-比特币挖矿算力托管服务一站式平台')
        document.querySelector('meta[name="description"]').setAttribute('content', '算力网（www.suanli.com）是比特币挖矿一站式服务平台，拥有专业的挖矿及运营团队，目前拥有矿机托管，矿场投资，算力出售，算力转让等业务，切实为比特币挖矿爱好者提供一站式贴心服务。')
        next()
      }
    }, {
      path: '/mHome',
      name: 'mobileHome',
      component: MIndex
    }, {
      path: '/auth',
      component: Auth,
      children: [{
        path: 'login',
        name: 'login',
        component: Login,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '登录'
          next()
        }
      }, {
        path: 'regist',
        name: 'regist',
        component: Regist,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '注册'
          next()
        }
      }, {
        path: 'passwordRetrieval',
        name: 'passwordRetrieval',
        component: PasswordRetrieval,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '找回密码'
          next()
        }
      }]
    }, {
      path: '/bdc',
      component: Bdc,
      beforeEnter: (to, from, next) => {
        document.querySelector('title').innerHTML = '比特币矿机托管'
        document.querySelector('meta[name="keywords"]').setAttribute('content', '比特币矿机托管-国电输出,持久稳定,电力便宜-算力网')
        document.querySelector('meta[name="description"]').setAttribute('content', '算力网矿机托管服务，承接各种比特币矿机托管业务，20万千瓦国家电网，持久稳定，专业挖矿技术24小时维护，保障用户挖矿收益')
        next()
      }
    }, {
      path: '/cloudCompute',
      component: CloudCompute,
      beforeEnter: (to, from, next) => {
        document.querySelector('title').innerHTML = '比特币云矿机'
        document.querySelector('meta[name="keywords"]').setAttribute('content', '比特币云矿机-价格最低的云矿机产品大全－算力网')
        document.querySelector('meta[name="description"]').setAttribute('content', '算力网云矿机商城，汇集目前主流比特币云矿机产品，包括阿瓦隆7云矿机，S9云矿机以及E9矿机云算力产品，为比特币挖矿爱好者提供比特币云矿机购买服务。')
        next()
      },
      children: [{
        path: 'list/:type/:sort',
        name: 'computeShop',
        component: ComputeShop
      }, {
        path: 'detail/:id/:type',
        name: 'computeDetail',
        component: ComputeDetail
      }, {
        path: 'mining',
        name: 'mining',
        component: Mining
      }, {
        path: 'activity',
        name: 'activity',
        component: Activity,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '全新E9+ 限时秒杀'
          next()
        }
      },
      {
        path: 'activitya',
        name: 'activitya',
        component: Activitya,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '阿瓦隆A740 限时抢购'
          next()
        }
      }]
    }, {
      path: '/computeTransfer',
      component: ComputeTransfer,
      beforeEnter: (to, from, next) => {
        document.querySelector('title').innerHTML = '算力转让区'
        next()
      },
      children: [{
        path: 'list/:type/:sort',
        name: 'transferList',
        component: TransferList
      }, {
        path: 'detail/:type/:id',
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
          document.querySelector('title').innerHTML = '个人中心'
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
        path: 'incomeChart',
        name: 'incomeChart',
        component: IncomeChart
      }, {
        path: 'moneyFlow/:sort',
        name: 'moneyFlow',
        component: MoneyFlow
      }, {
        path: 'virtualCurrencyFlow/:sort',
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
        path: 'orderDetail/:type/:id',
        name: 'orderDetail',
        component: OrderDetail
      }, {
        path: 'message',
        name: 'message',
        component: Message
      }, {
        path: 'messageDetail/:id',
        name: 'messageDetail',
        component: MessageDetail
      }, {
        path: 'repayment/:status',
        name: 'repayment',
        component: Repayment
      }, {
        path: 'repaymentDetail/:id',
        name: 'repaymentDetail',
        component: RepaymentDetail
      }, {
        path: 'recharge',
        name: 'recharge',
        component: Recharge
      }]
    }, {
      path: '/article',
      component: Article,
      children: [{
        path: 'accountEvaluate',
        name: 'accountEvaluate',
        component: AccountEvaluate
      }]
    }, {
      path: '/mine',
      component: Mine
    }, {
      path: '/webInfo',
      component: WebInfo,
      children: [{
        path: 'issues',
        name: 'issues',
        component: Issues,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '常见问题'
          next()
        }
      }, {
        path: 'issuesDetail/:id',
        name: 'issuesDetail',
        component: IssuesDetail,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '问题详情'
          next()
        }
      }, {
        path: 'list/:type',
        name: 'list',
        component: WebInfoList
      }, {
        path: 'detail/:type/:id',
        name: 'webInfoDetail',
        component: WebInfoDetail
      }, {
        path: 'aboutUs',
        name: 'aboutUs',
        component: AboutUs,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '关于我们'
          document.querySelector('meta[name="description"]').setAttribute('content', '算力网（www.suanLi.com）是由浙江数秦科技有限公司开发的云算力租赁及云矿机托管一站式服务平台，公司成立于2017年，由浙江数秦科技有限公司及多家上市公司、独立基金共同打造，并由浙江数秦科技有限公司独立运营，目前算力网以矿机托管，云矿机出售，云算力租赁为主营业务。算力网支持各大主流比特币矿机，例如A7，S9，E9等，连接全球最大比特币矿机生产商、矿池等资源，让用户通过网络即可实现远程挖矿，体验科技的同时享受算力产生的比特币。')
          next()
        }
      }]
    }, {
      path: '/mobile',
      component: Mobile,
      children: [{
        path: 'bdcForm',
        name: 'mbdcForm',
        component: MbdcForm
      },
      {
        path: 'help',
        name: 'mhelp',
        component: Mhelp
      },
      {
        path: 'administration',
        name: 'madministration',
        component: Madministration
      },
      {
        path: 'information',
        name: 'minformation',
        component: Minformation
      },
      {
        path: 'news',
        name: 'mnews',
        component: Mnews
      },
      {
        path: 'personcenter',
        name: 'mpersoncenter',
        component: Mpersoncenter
      },
      {
        path: 'notice',
        name: 'mnotice',
        component: Mnotice
      },
      {
        path: 'address',
        name: 'maddress',
        component: Maddress
      },
      {
        path: 'message',
        name: 'mmessage',
        component: Mmessage
      },
      {
        path: 'order/:type/:status',
        name: 'morder',
        component: Order
      },
      {
        path: 'orderDetail/:type/:status',
        name: 'morderDetail',
        component: OrderDetail
      },
      {
        path: 'property',
        name: 'mproperty',
        component: Mproperty
      },
      {
        path: 'moneyFlow',
        name: 'mmoneyFlow',
        component: MmoneyFlow
      },
      {
        path: 'recharge',
        name: 'mrecharge',
        component: Recharge
      }]
    }]
  })
