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
        }]
      }, {
        path: '/bdc',
        name: 'bdc',
        component: Bdc
      }, {
        path: '/minerShop',
        component: minerShop,
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
          component: Activity
        }]
      }, {
        path: '/compute',
        component: compute,
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
          component: Issues
        }, {
          path: 'issuesDetail/:id',
          name: 'issuesDetail',
          component: IssuesDetail
        }, {
          path: 'list/:type',
          name: 'webInfoList',
          component: WebInfoList
        }, {
          path: 'detail/:id',
          name: 'webInfoDetail',
          component: WebInfoDetail
        }, {
          path: 'aboutUs',
          name: 'aboutUs',
          component: AboutUs
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
        component: ComputeHome
      }, {
        path: '/computeNews',
        name: 'computeNews',
        component: ComputeNews,
        children: [{
          path: 'list',
          name: 'computeNewsList',
          component: WebInfoList
        }, {
          path: 'detail/:id',
          name: 'computeNewsDetail',
          component: WebInfoDetail
        }]
      }, {
        path: '/quickNews',
        component: ComputeNews,
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
        component: Transaction
      }, {
        path: '/equipments',
        component: ComputeNews,
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
