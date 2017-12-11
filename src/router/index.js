// components config
  import Vue from 'vue'
  import Router from 'vue-router'
// modules
  import Home from '@/views/Home'
  import NotFound from '@/views/NotFound'
  import Bdc from '@/views/Bdc'
  import Auth from '@/views/Auth'
  import minerShop from '@/views/minerShop'
  import compute from '@/views/compute'
  import User from '@/views/User'
  import WebInfo from '@/views/WebInfo'
  import ComputeHome from '@/views/ComputeHome'
// auth
  import Login from '@/components/auth/Login'
  import Regist from '@/components/auth/Regist'
  import PasswordRetrieval from '@/components/auth/PasswordRetrieval'
// miner
  import MinerList from '@/components/miner/MinerList'
  import Miner from '@/components/miner/Miner'
  import MinerDetail from '@/components/miner/Detail'
  import Mining from '@/components/miner/Mining'
  import Activity from '@/components/miner/Activity'
// compute
  import ComputeList from '@/components/compute/List'
  import ComputeDetail from '@/components/compute/Detail'
// user
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
  import Calculator from '@/components/user/Calculator'
  import AccountEvaluate from '@/components/user/AccountEvaluate'
  import AddressManage from '@/components/user/AddressManage'
// webInfo
  import AboutUs from '@/components/info/AboutUs'
  import Issues from '@/components/info/Issues'
  import WebInfoList from '@/components/info/list'
  import WebInfoDetail from '@/components/info/Detail'
  import IssuesDetail from '@/components/info/IssuesDetail'
// industryInformation
  import pageFrame from '@/components/ComputeNews/pageFrame'
  import Currency from '@/components/ComputeNews/Currency'
  import NewsFlash from '@/components/ComputeNews/quickNews'
  import Transaction from '@/components/ComputeNews/Transaction'
  import MinerMuseum from '@/components/ComputeNews/MinerMuseum'
  import EquipmentEvaluate from '@/components/ComputeNews/equipmentEvaluate'
  import Manufacturer from '@/components/ComputeNews/manufacturer'
  import DigitalCurrency from '@/components/ComputeNews/digitalCurrency'
  import Chart from '@/components/ComputeNews/Chart'
// mobile
  import Mobile from '@/views/Mobile'
  import MbdcForm from '@/components/mobile/MbdcForm'
  import Mhelp from '@/components/mobile/Mhelp'
  import Mnotice from '@/components/mobile/Mnotice'
  import Madvice from '@/components/mobile/Madvice'
  import Mproperty from '@/components/mobile/Mproperty'
  import Minformation from '@/components/mobile/Minformation'
  import Mpersoncenter from '@/components/mobile/Mpersoncenter'
  import ManuFacturermobile from '@/components/mobile/ManuFacturermobile'
// export
  Vue.use(Router)
  export default new Router({
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
      name: 'Bdc',
      component: Bdc
    }, {
      path: '/minerShop',
      component: minerShop,
      children: [{
        path: 'list',
        name: 'minerList',
        component: MinerList
      }, {
        path: 'miner/:type',
        name: 'miner',
        component: Miner
      }, {
        path: 'detail/:id',
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
        path: 'list/:type',
        name: 'computeList',
        component: ComputeList
      }, {
        path: 'detail/:id',
        name: 'computeDetail',
        component: ComputeDetail
      }]
    }, {
      path: '/user',
      component: User,
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
        path: 'order/:type',
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
        path: 'manuFacturermobile',
        name: 'manuFacturermobile',
        component: ManuFacturermobile
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
        component: Mpersoncenter
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
        component: Mproperty
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
      name: 'industryInformation',
      component: ComputeHome
    }, {
      path: '/currency',
      component: Currency
    }, {
      path: '/transaction',
      component: Transaction
    }, {
      path: '/computeNews',
      name: 'computeNews',
      component: pageFrame,
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
      name: 'quickNews',
      component: NewsFlash
    }, {
      path: '/digitalCurrency',
      component: pageFrame,
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
      path: '/equipments',
      component: pageFrame,
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
      component: pageFrame,
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
      component: pageFrame,
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
      path: '/computeChart',
      name: 'computeChart',
      component: Chart
    }]
  })
