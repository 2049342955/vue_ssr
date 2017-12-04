// components config
  import Vue from 'vue'
  import Router from 'vue-router'
// modules
  const Home = () => import('@/views/Home')
  const NotFound = () => import('@/views/NotFound')
  const Bdc = () => import('@/views/Bdc')
  const Auth = () => import('@/views/Auth')
  const minerShop = () => import('@/views/minerShop')
  const compute = () => import('@/views/compute')
  const User = () => import('@/views/User')
  const WebInfo = () => import('@/views/WebInfo')
  const ComputeNews = () => import('@/views/ComputeNews')
// auth
  const Login = () => import('@/components/auth/Login')
  const Regist = () => import('@/components/auth/Regist')
  const PasswordRetrieval = () => import('@/components/auth/PasswordRetrieval')
// miner
  const MinerList = () => import('@/components/miner/MinerList')
  const Miner = () => import('@/components/miner/Miner')
  const MinerDetail = () => import('@/components/miner/Detail')
  const Mining = () => import('@/components/miner/Mining')
  const Activity = () => import('@/components/miner/Activity')
// compute
  const ComputeList = () => import('@/components/compute/List')
  const ComputeDetail = () => import('@/components/compute/Detail')
// user
  const Message = () => import('@/components/user/Message')
  const MessageDetail = () => import('@/components/user/MessageDetail')
  const Repayment = () => import('@/components/user/Repayment')
  const RepaymentDetail = () => import('@/components/user/RepaymentDetail')
  const Recharge = () => import('@/components/user/Recharge')
  const Account = () => import('@/components/user/Account')
  const LpCenter = () => import('@/components/user/LpCenter')
  const ComputeProperty = () => import('@/components/user/ComputeProperty')
  const IncomeChart = () => import('@/components/user/IncomeChart')
  const MoneyFlow = () => import('@/components/user/MoneyFlow')
  const VirtualCurrencyFlow = () => import('@/components/user/VirtualCurrencyFlow')
  const Password = () => import('@/components/user/Password')
  const Order = () => import('@/components/user/Order')
  const OrderDetail = () => import('@/components/user/OrderDetail')
  const Calculator = () => import('@/components/user/Calculator')
  const AccountEvaluate = () => import('@/components/user/AccountEvaluate')
  const AddressManage = () => import('@/components/user/AddressManage')
// webInfo
  const AboutUs = () => import('@/components/info/AboutUs')
  const Issues = () => import('@/components/info/Issues')
  const WebInfoList = () => import('@/components/info/List')
  const WebInfoDetail = () => import('@/components/info/Detail')
  const IssuesDetail = () => import('@/components/info/IssuesDetail')
// industryInformation
  const ComputeHome = () => import('@/components/ComputeNews/ComputeHome')
  const NewsFlash = () => import('@/components/ComputeNews/NewsFlash')
  const Transaction = () => import('@/components/ComputeNews/Transaction')
  const MinerMuseum = () => import('@/components/ComputeNews/MinerMuseum')
  const DigitalCurrency = () => import('@/components/ComputeNews/DigitalCurrency')
  const EquipmentEvaluate = () => import('@/components/ComputeNews/EquipmentEvaluate')
  const Manufacturer = () => import('@/components/ComputeNews/Manufacturer')
// mobile
  const Mobile = () => import('@/views/Mobile')
  const MbdcForm = () => import('@/components/mobile/MbdcForm')
  const Mhelp = () => import('@/components/mobile/Mhelp')
  const Mnotice = () => import('@/components/mobile/Mnotice')
  const Madvice = () => import('@/components/mobile/Madvice')
  const Mproperty = () => import('@/components/mobile/Mproperty')
  const Minformation = () => import('@/components/mobile/Minformation')
  const Mpersoncenter = () => import('@/components/mobile/Mpersoncenter')
// export
  Vue.use(Router)

  export function createRouter () {
    return new Router({
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
          document.querySelector('title').innerHTML = '算力网-比特币挖矿算力托管服务一站式平台'
          document.title = to.meta.title || '算力网-比特币挖矿算力托管服务一站式平台'
          document.querySelector('meta[name="keywords"]').setAttribute('content', '算力网-比特币挖矿算力托管服务一站式平台')
          document.querySelector('meta[name="description"]').setAttribute('content', '算力网（www.suanli.com）是比特币挖矿一站式服务平台，拥有专业的挖矿及运营团队，目前拥有矿机托管，矿场投资，算力出售，算力转让等业务，切实为比特币挖矿爱好者提供一站式贴心服务。')
          next()
        }
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
          document.querySelector('title').innerHTML = '比特币矿机托管-国电输出,持久稳定,电力便宜-算力网'
          document.querySelector('meta[name="keywords"]').setAttribute('content', '比特币矿机托管-国电输出,持久稳定,电力便宜-算力网')
          document.querySelector('meta[name="description"]').setAttribute('content', '算力网矿机托管服务，承接各种比特币矿机托管业务，20万千瓦国家电网，持久稳定，专业挖矿技术24小时维护，保障用户挖矿收益')
          next()
        }
      }, {
        path: '/minerShop',
        component: minerShop,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '比特币云矿机-价格最低的云矿机产品大全－算力网'
          document.querySelector('meta[name="keywords"]').setAttribute('content', '比特币云矿机-价格最低的云矿机产品大全－算力网')
          document.querySelector('meta[name="description"]').setAttribute('content', '算力网云矿机商城，汇集目前主流比特币云矿机产品，包括阿瓦隆7云矿机，S9云矿机以及E9矿机云算力产品，为比特币挖矿爱好者提供比特币云矿机购买服务。')
          next()
        },
        children: [{
          path: 'list',
          name: 'minerList',
          component: MinerList
        }, {
          path: 'miner/:type/:sort',
          name: 'miner',
          component: Miner
        }, {
          path: 'detail/:id/:type',
          name: 'minerDetail',
          component: MinerDetail
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
        }]
      }, {
        path: '/compute',
        component: compute,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '算力转让区'
          next()
        },
        children: [{
          path: 'list/:type/:sort',
          name: 'computeList',
          component: ComputeList
        }, {
          path: 'detail/:type/:id',
          name: 'computeDetail',
          component: ComputeDetail
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
          path: 'calculator',
          name: 'calculator',
          component: Calculator
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
        }, {
          path: 'accountEvaluate',
          name: 'accountEvaluate',
          component: AccountEvaluate
        }, {
          path: 'address',
          name: 'addressManage',
          component: AddressManage
        }]
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
          name: 'webInfoList',
          component: WebInfoList,
          beforeEnter: (to, from, next) => {
            document.querySelector('title').innerHTML = '算力新闻_比特币资讯－算力网'
            document.querySelector('meta[name="description"]').setAttribute('content', '算力网（www.suanli.com)产业新闻栏目，为你提供各种算力产业资讯，比特币新闻，行业动态，关注算力网，开启你的挖矿之旅')
            next()
          }
        }, {
          path: 'detail/:id',
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
          component: Account
        },
        {
          path: 'information',
          name: 'minformation',
          component: Minformation
        },
        {
          path: 'message',
          name: 'mmessage',
          component: Message
        },
        {
          path: 'personcenter',
          name: 'mpersoncenter',
          component: Mpersoncenter,
          beforeEnter: (to, from, next) => {
            var data = localStorage.getItem('info')
            if (!data) {
              next({ name: 'login' })
            } else {
              next()
            }
          }
        },
        {
          path: 'notice',
          name: 'mnotice',
          component: Mnotice
        },
        {
          path: 'advice',
          name: 'madvice',
          component: Madvice
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
          component: Mproperty,
          beforeEnter: (to, from, next) => {
            var data = localStorage.getItem('info')
            if (!data) {
              next({ name: 'login' })
            } else {
              next()
            }
          }
        },
        {
          path: 'moneyFlow',
          name: 'mmoneyFlow',
          component: MoneyFlow
        },
        {
          path: 'recharge',
          name: 'mrecharge',
          component: Recharge
        }, {
          path: 'address',
          name: 'maddressManage',
          component: AddressManage
        }]
      }, {
        path: '/industryInformation',
        component: ComputeHome,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '产业资讯'
          next()
        }
      }, {
        path: '/computeNews',
        name: 'computeNews',
        component: ComputeNews,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '算力资讯'
          next()
        },
        children: [{
          path: 'list',
          name: 'computeNewsList',
          component: WebInfoList,
          beforeEnter: (to, from, next) => {
            document.querySelector('title').innerHTML = '算力新闻_比特币资讯－算力网'
            document.querySelector('meta[name="description"]').setAttribute('content', '算力网（www.suanli.com)产业新闻栏目，为你提供各种算力产业资讯，比特币新闻，行业动态，关注算力网，开启你的挖矿之旅')
            next()
          }
        }, {
          path: 'detail/:id',
          name: 'computeNewsDetail',
          component: WebInfoDetail
        }]
      }, {
        path: '/quickNews',
        component: ComputeNews,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '快报'
          next()
        },
        children: [{
          path: 'list',
          name: 'quickNewsList',
          component: NewsFlash
        }, {
          path: 'detail/:id',
          name: 'quickNewsDetail',
          component: WebInfoDetail
        }]
      }, {
        path: '/transaction',
        component: Transaction,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '交易信息'
          next()
        }
      }, {
        path: '/equipments',
        component: ComputeNews,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '设备博物馆'
          next()
        },
        children: [{
          path: 'list',
          name: 'minerMuseum',
          component: MinerMuseum
        }, {
          path: 'detail/:id',
          name: 'minerMuseumDetail',
          component: WebInfoDetail
        }]
      }, {
        path: '/equipmentEvaluate',
        component: ComputeNews,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '设备测评'
          next()
        },
        children: [{
          path: 'list',
          name: 'equipmentEvaluate',
          component: EquipmentEvaluate
        }, {
          path: 'detail/:id',
          name: 'equipmentEvaluateDetail',
          component: WebInfoDetail
        }]
      }, {
        path: '/manufacturer',
        component: ComputeNews,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '厂商'
          next()
        },
        children: [{
          path: 'list',
          name: 'manufacturer',
          component: Manufacturer
        }, {
          path: 'detail/:id',
          name: 'manufacturerDetail',
          component: WebInfoDetail
        }]
      }, {
        path: '/digitalCurrency',
        component: ComputeNews,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '数字货币'
          next()
        },
        children: [{
          path: 'list',
          name: 'digitalCurrency',
          component: DigitalCurrency
        }, {
          path: 'detail/:id',
          name: 'digitalCurrencyDetail',
          component: WebInfoDetail
        }]
      }, {
        path: '/miner',
        component: ComputeNews,
        beforeEnter: (to, from, next) => {
          document.querySelector('title').innerHTML = '矿场相册'
          next()
        },
        children: [{
          path: 'list',
          name: 'minerPhotoList',
          component: WebInfoList
        }, {
          path: 'detail/:id',
          name: 'minerPhotoDetail',
          component: WebInfoDetail
        }]
      }]
    })
  }
