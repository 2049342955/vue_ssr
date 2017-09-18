  <aside id="sidebar_left" class="nano nano-light">

    <!-- Start: Sidebar Left Content -->
    <div class="sidebar-left-content nano-content">

      <!-- Start: Sidebar Menu -->
      <ul class="nav sidebar-menu">


        <li class="sidebar-label pt20">菜单</li>
  
        <!-- 首页管理 -->
        @if( strpos(Route::getCurrentRoute()->uri(), 'home') !== false || strpos(Route::getCurrentRoute()->uri(), 'banner') !== false || strpos(Route::getCurrentRoute()->uri(), 'information') !== false )
          <li class="dropNav myDropNav active">
            <a class="firstDrop accordion-toggle menu-open">
        @else
          <li class="dropNav myDropNav">
            <a class="firstDrop accordion-toggle">
        @endif
              <span class="glyphicon glyphicon-home"></span>
              <span class="sidebar-title">首页管理</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'home') !== false || strpos(Route::getCurrentRoute()->uri(), 'banner') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(), 'home') !== false || strpos(Route::getCurrentRoute()->uri(), 'banner') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="home">
                  <span class="fa fa-columns"></span>
                  <span>banner管理</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(), 'information/module') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="information/module">
                  <span class="fa fa-columns"></span>
                  <span>信息模块管理</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(), 'information/content') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="information/content">
                  <span class="fa fa-columns"></span>
                  <span>信息内容管理</span>
                </a>
              </li>

            </ul>      
          </li>

        <!-- 常见问题管理 -->
        @if( strpos(Route::getCurrentRoute()->uri(), 'help') !== false )
            <li class="dropNav myDropNav active">
              <a class="firstDrop accordion-toggle menu-open">
          @else
            <li class="dropNav myDropNav">
              <a class="firstDrop accordion-toggle">
          @endif
              <span class="glyphicon glyphicon-question-sign"></span>
              <span class="sidebar-title">常见问题管理</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'help') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(),'help_module') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="help_module">
                  <span class="fa fa-columns"></span>
                  <span>模块管理</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(), 'help_content') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="help_content">
                  <span class="fa fa-columns"></span>
                  <span>内容管理</span>
                </a>
              </li>

            </ul>      
          </li>

        <!-- 用户管理 -->
        @if( strpos(Route::getCurrentRoute()->uri(), 'user') !== false )
          <li class="dropNav myDropNav active">
            <a class="firstDrop accordion-toggle menu-open">
        @else
          <li class="dropNav myDropNav">
            <a class="firstDrop accordion-toggle">
        @endif
              <span class="glyphicon glyphicon-user"></span>
              <span class="sidebar-title">用户管理</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'user') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(), 'usermsg') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="usermsg">
                  <span class="fa fa-columns"></span>
                  <span>用户信息</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(), 'user_verify') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="user_verify">
                  <span class="fa fa-columns"></span>
                  <span>认证资料</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(), 'user_bindcard') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="user_bindcard">
                  <span class="fa fa-columns"></span>
                  <span>银行卡绑定</span>
                </a>
              </li>

            </ul>      
          </li>

          <!-- 理财产品管理 -->
          @if( strpos(Route::getCurrentRoute()->uri(), 'product') !== false )
            <li class="dropNav myDropNav active">
              <a class="firstDrop accordion-toggle menu-open">
          @else
            <li class="dropNav myDropNav">
              <a class="firstDrop accordion-toggle">
          @endif
              <span class="glyphicon glyphicon-ruble"></span>
              <span class="sidebar-title">理财产品管理</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'product') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(),'product/hashtype') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="product/hashtype">
                  <span class="fa fa-columns"></span>
                  <span>算力类型管理</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(),'product/contract') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="product/contract">
                  <span class="fa fa-columns"></span>
                  <span>合同模板管理</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(),'product/base') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="product/base">
                  <span class="fa fa-columns"></span>
                  <span>产品基类设置</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(),'product/manage') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="product/manage">
                  <span class="fa fa-columns"></span>
                  <span>产品管理</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(), 'product/settle') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="product/settle">
                  <span class="fa fa-columns"></span>
                  <span>产品结算</span>
                </a>
              </li>

            </ul>      
          </li>

          <!-- 转让产品管理 -->
          @if( strpos(Route::getCurrentRoute()->uri(), 'attorn') !== false )
            <li class="dropNav myDropNav active">
              <a class="firstDrop accordion-toggle menu-open">
          @else
            <li class="dropNav myDropNav">
              <a class="firstDrop accordion-toggle">
          @endif
              <span class="glyphicon glyphicon-transfer"></span>
              <span class="sidebar-title">转让产品管理</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'attorn') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(),'attorn') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="attorn">
                  <span class="fa fa-columns"></span>
                  <span>转让列表</span>
                </a>
              </li>

            </ul>      
          </li>

          <!-- 
          @if( strpos(Route::getCurrentRoute()->uri(), 'award') !== false )
            <li class="dropNav myDropNav active">
              <a class="firstDrop accordion-toggle menu-open">
          @else
            <li class="dropNav myDropNav">
              <a class="firstDrop accordion-toggle">
          @endif
              <span class="glyphicon glyphicon-piggy-bank"></span>
              <span class="sidebar-title">推广奖励管理</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'award') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(),'award') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="award">
                  <span class="fa fa-columns"></span>
                  <span>推广奖励列表</span>
                </a>
              </li>

            </ul>      
          </li>
 -->
          <!-- 人民币管理 -->
          @if( strpos(Route::getCurrentRoute()->uri(), 'yen') !== false )
            <li class="dropNav myDropNav active">
              <a class="firstDrop accordion-toggle menu-open">
          @else
            <li class="dropNav myDropNav">
              <a class="firstDrop accordion-toggle">
          @endif
              <span class="glyphicon glyphicon-yen"></span>
              <span class="sidebar-title">人民币</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'yen') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(),'yen/recharge') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="yen/recharge">
                  <span class="fa fa-columns"></span>
                  <span>充值列表</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(),'yen/withdraw') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="yen/withdraw">
                  <span class="fa fa-columns"></span>
                  <span>提现管理</span>
                </a>
              </li>

            </ul>      
          </li>

          <!-- 数字货币管理 -->
          @if( strpos(Route::getCurrentRoute()->uri(), 'digitalcoin') !== false )
            <li class="dropNav myDropNav active">
              <a class="firstDrop accordion-toggle menu-open">
          @else
            <li class="dropNav myDropNav">
              <a class="firstDrop accordion-toggle">
          @endif
              <span class="glyphicon glyphicon-bitcoin"></span>
              <span class="sidebar-title">数字货币管理</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'digitalcoin') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(),'digitalcoin/withdraw') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="digitalcoin/withdraw">
                  <span class="fa fa-columns"></span>
                  <span>提币管理</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(),'digitalcoin/transfer') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="digitalcoin/transfer">
                  <span class="fa fa-columns"></span>
                  <span>兑换列表</span>
                </a>
              </li>

            </ul>      
          </li>

          <!-- 数据对账 -->
          @if( strpos(Route::getCurrentRoute()->uri(), 'statistics') !== false )
            <li class="dropNav myDropNav active">
              <a class="firstDrop accordion-toggle menu-open">
          @else
            <li class="dropNav myDropNav">
              <a class="firstDrop accordion-toggle">
          @endif
              <span class="glyphicon glyphicon-equalizer"></span>
              <span class="sidebar-title">数据统计对账</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'statistics') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(),'statistics/yuanstat') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="statistics/yuanstat">
                  <span class="fa fa-columns"></span>
                  <span>人民币统计</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(),'statistics/digitalstat') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="statistics/digitalstat">
                  <span class="fa fa-columns"></span>
                  <span>数字货币统计</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(),'statistics/yuancash') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="statistics/yuancash">
                  <span class="fa fa-columns"></span>
                  <span>用户账户人民币</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(),'statistics/digitalcash') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="statistics/digitalcash">
                  <span class="fa fa-columns"></span>
                  <span>用户账户数字货币</span>
                </a>
              </li>

            </ul>      
          </li>


          @if( strpos(Route::getCurrentRoute()->uri(), 'admin') !== false )
            <li class="dropNav myDropNav active">
              <a class="firstDrop accordion-toggle menu-open">
          @else
            <li class="dropNav myDropNav">
              <a class="firstDrop accordion-toggle">
          @endif
              <span class="glyphicon glyphicon-lock"></span>
              <span class="sidebar-title">账户权限管理</span>
              <span class="caret"></span>
            </a>

            @if( strpos(Route::getCurrentRoute()->uri(), 'admin') !== false )
            <ul class="nav sub-nav" style="display:block">
            @else
            <ul class="nav sub-nav">
            @endif

              @if( strpos(Route::getCurrentRoute()->uri(),'admin_roles') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="admin_roles">
                  <span class="fa fa-columns"></span>
                  <span>角色管理</span>
                </a>
              </li>

              @if( strpos(Route::getCurrentRoute()->uri(), 'admin_account') !== false )
              <li class="dropNav myDropNav active">
              @else
              <li class="dropNav myDropNav">
              @endif
                  <a class="firstDrop" href="admin_account">
                  <span class="fa fa-columns"></span>
                  <span>账户管理</span>
                </a>
              </li>

            </ul>      
          </li>


      </ul>

      
      <!-- End: Sidebar Menu -->

      <!-- Start: Sidebar Collapse Button -->
      <div class="sidebar-toggle-mini">
        <a href="#">
          <span class="fa fa-sign-out"></span>
        </a>
      </div>
      <!-- End: Sidebar Collapse Button -->

    </div>
    <!-- End: Sidebar Left Content -->

  </aside>
   