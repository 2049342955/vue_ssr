<template>
  <section class="account_evaluate">
    <div class="box">
      <h2>风险测评</h2>
      <form class="test" @submit.prevent="submit" novalidate>
        <h4>欢迎参加本次调查</h4>
        <aside v-for="d,i in data">
          <div class="question" :ref="'question'+i">{{d.question}}<span>请选择</span></div>
          <div class="answer">
            <label :for="'answer'+i+k" v-for="q,k in d.options">
              <input type="radio" :id="'answer'+i+k" :name="'question'+i" :value="k">
              <span>{{q}}</span>
            </label>
          </div>
        </aside>
        <div class="btn"><button>确认提交</button></div>
      </form>
    </div>
  </section>
</template>

<script>
  import api from '@/util/function'
  import util from '@/util'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        data: [{question: 'Q1：您的家庭年收入情况：', options: ['≤ 3 万元', '3—10 万元', '10—50 万元', '50—100 万元', '≥ 100 万元'], answer: 1}, {question: 'Q2：最近您家庭预计进行证券投资的资金占家庭现有总 资产 ( 不含自住房产及自用汽车等固定资产 ) 的比例是：', options: ['70% 以上', '50%—70%', '30%—50%', '10%—30%', '10% 以下'], answer: 1}, {question: 'Q3：您是否有数额较大的债务：', options: ['没有', '有，为房贷等长期债务', '有，信用卡、消费信贷等短期债务', '有，向亲戚朋友借款'], answer: 1}, {question: 'Q4：以下描述符合您实际情况的是：', options: ['自修并略懂金融、财经、投资类知识', '具有金融、财经、投资类学习经历', '从事过金融、财经、投资相关工作', '我没有金融投资专业知识'], answer: 1}, {question: 'Q5：您的投资经验情况为：', options: ['有限：只把钱存放银行或购买低风险理财产品', '一般：我购买过基金、保险等理财产品，但需要进一步的指导', '丰富：我参与过股票、基金等产品的交易，投资经验较丰富', '非常丰富：我参与过权证、期货或创业板等高风险产品的交易，经验很丰富'], answer: 1}, {question: 'Q6：您用于证券投资的大部分资金的投资期限为：', options: ['短期——0 到 1 年', '中期——1 到 5 年', '长期——5 年以上'], answer: 1}, {question: 'Q7：您打算投资于哪些品种：', options: ['债券、货币市场基金、债券基金等固定收益类投资品种', '股票、混合型基金、偏股型基金、股票型基金等权益类投资品种', '期货、融资融券', '复杂或高风险金融产品', '其他产品'], answer: 1}]
      }
    },
    methods: {
      submit () {
        var form = document.querySelector('.test')
        var data = []
        for (var i = 0; i <= 6; i++) {
          var ele = this.$refs['question' + i][0]
          if ((form['question' + i].value) !== '') {
            data.push(form['question' + i].value)
            ele.classList.remove('active')
          } else {
            form['question' + i][0].focus()
            ele.classList.add('active')
            return false
          }
        }
        var score = data.reduce((s, v, k) => {
          return parseInt(s) + parseInt(v)
        })
        var self = this
        util.post('risk_score', {sign: api.serialize({user_risk_score: score, token: this.token, user_id: this.user_id})}).then(function (data) {
          if (data) {
            self.$router.push({name: 'account'})
          }
        })
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id
      })
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .account_evaluate{
    background: #f7f8fa;
    padding:40px 0;
    .box{
      @include main
      background: $white;
      min-height:800px;
      h2{
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        padding:18px 0;
        border-bottom:1px solid $border
      }
      .test{
        padding:40px 50px;
        font-size: 16px;
        h4{
          margin-bottom:30px;
        }
        aside{
          margin-bottom:15px;
          .question{
            span{
              color: $red;
              font-size: 12px;
              padding-left:10px;
              display: none;
            }
            &.active span{
              display: inline;
            }
          }
          .answer{
            padding-left:10px;
            label{
              display: block;
              margin-top:10px;
              input{
                @include checkbox(18)
                margin-right:5px;
              }
            }
          }
        }
        .btn{
          text-align: center;
          button{
            padding:10px 50px;
            @include button($blue)
            font-size: 16px;
          }
        }
      }
    }
  }
</style>
