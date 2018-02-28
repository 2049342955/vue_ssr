// components config
  import Vue from 'vue'
  import Router from 'vue-router'

// home
  const Container = () => import('@/components/common/Container')
  const Home = () => import('@/views')

  const home = {
    path: '/',
    name: 'home',
    component: Home
  }
// notFound
  const NotFound = () => import('@/views/notFound')

  const notFound = {
    path: '*',
    name: 'notFound',
    component: NotFound
  }
// bdc
  const Bdc = () => import('@/views/bdc')

  const bdc = {
    path: '/bdc',
    name: 'bdc',
    component: Bdc
  }
// auth
  const Auth = () => import('@/views/auth')
  const Login = () => import('@/views/auth/login')
  const Regist = () => import('@/views/auth/regist')
  const PasswordRetrieval = () => import('@/views/auth/passwordRetrieval')

  const auth = {
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
  }
// minerShop
  const MinerShop = () => import('@/views/minerShop')
  const Mining = () => import('@/views/minerShop/Mining')
  const Activity = () => import('@/views/minerShop/Activity')

  const minerShop = {
    path: '/minerShop',
    component: Container,
    children: [{
      path: '/',
      name: 'minerShop',
      component: MinerShop
    }, {
      path: 'mining',
      name: 'mining',
      component: Mining
    }, {
      path: 'activity',
      name: 'activity',
      component: Activity
    }]
  }
// miner
  const Miner = () => import('@/views/minerShop/miner')
  const MinerDetail = () => import('@/views/minerShop/miner/detail')
  const MinerPay = () => import('@/views/minerShop/miner/pay')
  const MinerPaySuccess = () => import('@/views/minerShop/miner/paySuccess')

  const miner = {
    path: '/miner',
    component: Container,
    children: [{
      path: '/',
      name: 'minerList',
      component: Miner
    }, {
      path: 'detail/:id',
      name: 'minerDetail',
      component: MinerDetail
    }, {
      path: 'pay',
      name: 'minerPay',
      component: MinerPay
    }, {
      path: 'paySuccess',
      name: 'minerPaySuccess',
      component: MinerPaySuccess
    }]
  }
// cloudCompute
  const CloudCompute = () => import('@/views/minerShop/cloudCompute')
  const CloudComputeDetail = () => import('@/views/minerShop/cloudCompute/detail')
  const CloudComputeHirePurchase = () => import('@/views/minerShop/cloudCompute/hirePurchase')
  const CloudComputePay = () => import('@/views/minerShop/cloudCompute/pay')
  const CloudComputePaySuccess = () => import('@/views/minerShop/cloudCompute/paySuccess')

  const cloudCompute = {
    path: '/cloudCompute',
    component: Container,
    children: [{
      path: '/',
      name: 'cloudComputeList',
      component: CloudCompute
    }, {
      path: 'detail/:id',
      name: 'cloudComputeDetail',
      component: CloudComputeDetail
    }, {
      path: 'pay',
      name: 'CloudComputePay',
      component: CloudComputePay
    }, {
      path: 'hirePurchase',
      name: 'cloudComputeHirePurchase',
      component: CloudComputeHirePurchase
    }, {
      path: 'paySuccess',
      name: 'cloudComputePaySuccess',
      component: CloudComputePaySuccess
    }]
  }
// user
  const User = () => import('@/views/user')
  const Property = () => import('@/views/user/property')
  const Recharge = () => import('@/views/user/recharge')
  const Account = () => import('@/views/user/account')
  const Address = () => import('@/views/user/address')
  const AccountEvaluation = () => import('@/views/user/evaluation')

  const LpCenter = () => import('@/views/user/lpCenter')
  const Calculator = () => import('@/views/user/calculator')
  const MoneyFlow = () => import('@/views/user/moneyFlow')
  const IncomeFlow = () => import('@/views/user/incomeFlow')
  const IncomeChart = () => import('@/views/user/incomeChart')

  const Order = () => import('@/views/user/order')
  const OrderDetail = () => import('@/views/user/order/detail')
  const Message = () => import('@/views/user/message')
  const MessageDetail = () => import('@/views/user/message/detail')

  const Repayment = () => import('@/views/user/repayment')
  const RepaymentDetail = () => import('@/views/user/repayment/detail')
  const Deposit = () => import('@/views/user/deposit')
  const DepositDetail = () => import('@/views/user/deposit/detail')

  const user = {
    path: '/user',
    component: User,
    // beforeEnter: (to, from, next) => {
    //   var data = localStorage.getItem('info')
    //   if (!data) {
    //     next({ name: 'login' })
    //   } else {
    //     next()
    //   }
    // },
    children: [{
      path: 'property',
      name: 'property',
      component: Property
    }, {
      path: 'recharge',
      name: 'recharge',
      component: Recharge
    }, {
      path: 'account',
      name: 'account',
      component: Account
    }, {
      path: 'address',
      name: 'address',
      component: Address
    }, {
      path: 'evaluation',
      name: 'accountEvaluation',
      component: AccountEvaluation
    }, {
      path: 'lpCenter',
      name: 'lpCenter',
      component: LpCenter
    }, {
      path: 'calculator',
      name: 'calculator',
      component: Calculator
    }, {
      path: 'incomeChart',
      name: 'incomeChart',
      component: IncomeChart
    }, {
      path: 'moneyFlow',
      name: 'moneyFlow',
      component: MoneyFlow
    }, {
      path: 'incomeFlow',
      name: 'incomeFlow',
      component: IncomeFlow
    }, {
      path: 'order/:status',
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
      path: 'deposit/:status',
      name: 'deposit',
      component: Deposit
    }, {
      path: 'depositDetail/:id',
      name: 'depositDetail',
      component: DepositDetail
    }]
  }
// webInfo
  const WebInfo = () => import('@/views/webInfo')
  const AboutUs = () => import('@/views/webInfo/aboutUs')
  const WebInfoList = () => import('@/views/webInfo/info')
  const WebInfoDetail = () => import('@/views/webInfo/info/detail')
  const Issues = () => import('@/views/webInfo/issues')
  const IssuesDetail = () => import('@/views/webInfo/issues/detail')

  const webInfo = {
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
      path: ':type',
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
  }
// industryInfo
  const IndustryInfo = () => import('@/views/industryInfo')

  const industryInfo = {
    path: '/industryInfo',
    name: 'industryInfo',
    component: IndustryInfo
  }
// news
  const News = () => import('@/views/industryInfo/news')
  const NewsDetail = () => import('@/views/industryInfo/news/detail')

  const news = {
    path: '/news',
    component: Container,
    children: [{
      path: '/',
      name: 'newsList',
      component: News
    }, {
      path: 'detail/:id',
      name: 'newsDetail',
      component: NewsDetail
    }]
  }
// currency
  const Currency = () => import('@/views/industryInfo/currency')
  const CurrencyDetail = () => import('@/views/industryInfo/currency/detail')

  const currency = {
    path: '/currency',
    component: Container,
    children: [{
      path: '/',
      name: 'currency',
      component: Currency
    }, {
      path: 'detail/:id',
      name: 'currencyDetail',
      component: CurrencyDetail
    }]
  }
// evaluation
  const Evaluation = () => import('@/views/industryInfo/evaluation')
  const EvaluationDetail = () => import('@/views/industryInfo/evaluation/detail')

  const evaluation = {
    path: '/evaluation',
    component: Container,
    children: [{
      path: '/',
      name: 'evaluation',
      component: Evaluation
    }, {
      path: 'detail/:id',
      name: 'evaluationDetail',
      component: EvaluationDetail
    }]
  }
// manufacturer
  const Manufacturer = () => import('@/views/industryInfo/manufacturer')
  const ManufacturerDetail = () => import('@/views/industryInfo/manufacturer/detail')

  const manufacturer = {
    path: '/manufacturer',
    component: Container,
    children: [{
      path: '/',
      name: 'manufacturer',
      component: Manufacturer
    }, {
      path: 'detail/:id',
      name: 'manufacturerDetail',
      component: ManufacturerDetail
    }]
  }
// museum
  const Museum = () => import('@/views/industryInfo/museum')
  const MuseumDetail = () => import('@/views/industryInfo/museum/detail')

  const museum = {
    path: '/museum',
    component: Container,
    children: [{
      path: '/',
      name: 'museum',
      component: Museum
    }, {
      path: 'detail/:id',
      name: 'museumDetail',
      component: MuseumDetail
    }]
  }
// quickNews
  const QuickNews = () => import('@/views/industryInfo/quickNews')

  const quickNews = {
    path: '/quickNews',
    name: 'quickNews',
    component: QuickNews
  }
// transaction
  const Transaction = () => import('@/views/industryInfo/transaction')

  const transaction = {
    path: '/transaction',
    name: 'transaction',
    component: Transaction
  }
// computeChart
  const ComputeChart = () => import('@/views/industryInfo/computeChart')

  const computeChart = {
    path: '/computeChart',
    name: 'computeChart',
    component: ComputeChart
  }
// mobile
  const Mobile = () => import('@/views/mobile')
  const MProperty = () => import('@/views/mobile/property')
  const MAssetsDetail = () => import('@/views/mobile/property/assetsDetail')
  const MCloudCompute = () => import('@/views/mobile/property/cloudCompute')

  const MPersonalCenter = () => import('@/views/mobile/user')
  const MAccount = () => import('@/views/mobile/user/account')
  const MAssetsAddress = () => import('@/views/mobile/user/assetsAddress')
  const MBankCard = () => import('@/views/mobile/user/bankCard')
  const MIdVerfication = () => import('@/views/mobile/user/idVerfication')

  const MBdcForm = () => import('@/views/mobile/bdcForm')
  const MAdvice = () => import('@/views/mobile/webInfo/advice')

  const MHelp = () => import('@/views/mobile/webInfo/help')
  const MInformation = () => import('@/views/mobile/webInfo/information')
  const MNotice = () => import('@/views/mobile/webInfo/notice')

  const mobile = {
    path: '/mobile',
    children: [{
      path: '/',
      name: 'mIndex',
      component: Mobile
    }, {
      path: 'property',
      name: 'mProperty',
      component: MProperty
      // beforeEnter: (to, from, next) => {
      //   var data = localStorage.getItem('info')
      //   if (!data) {
      //     next({ name: 'login' })
      //   } else {
      //     next()
      //   }
      // }
    }, {
      path: 'assetsDetail',
      name: 'mAssetsDetail',
      component: MAssetsDetail
    }, {
      path: 'cloudCompute',
      name: 'mCloudCompute',
      component: MCloudCompute
    }, {
      path: 'bdcForm',
      name: 'mBdcForm',
      component: MBdcForm
    }, {
      path: 'personalCenter',
      name: 'mPersonalCenter',
      component: MPersonalCenter
      // beforeEnter: (to, from, next) => {
      //   var data = localStorage.getItem('info')
      //   if (!data) {
      //     next({ name: 'login' })
      //   } else {
      //     next()
      //   }
      // }
    }, {
      path: 'account',
      name: 'mAccount',
      component: MAccount
    }, {
      path: 'assetsAddress',
      name: 'mAssetsAddress',
      component: MAssetsAddress
    }, {
      path: 'bankCard',
      name: 'mBankCard',
      component: MBankCard
    }, {
      path: 'idVerfication',
      name: 'mIdVerfication',
      component: MIdVerfication
    }, {
      path: 'help',
      name: 'mHelp',
      component: MHelp
    }, {
      path: 'information',
      name: 'mInformation',
      component: MInformation
    }, {
      path: 'notice',
      name: 'mnotice',
      component: MNotice
    }, {
      path: 'advice',
      name: 'madvice',
      component: MAdvice
    }]
  }

// export
  Vue.use(Router)

  export function createRouter () {
    return new Router({
      mode: 'history',
      routes: [
        home,
        notFound,
        bdc,
        auth,
        minerShop,
        miner,
        cloudCompute,
        user,
        webInfo,
        industryInfo,
        news,
        currency,
        evaluation,
        manufacturer,
        museum,
        quickNews,
        transaction,
        computeChart,
        mobile
      ]
    })
  }
