@extends('layout.index')
@section('content')
<main class="app-content">
    <div class="app-title">
      <div>
        
        <h1><img class="app-sidebar__user-avatar" height="100px;" width="100px;" src="template/docs/images/kantoran.png" alt="User Image">
          Dashboard</h1>
        <p>Selamat Datang di Aplikasi Manajemen Mesjid</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
        <li class="breadcrumb-item"><a href="{{ url('/mesjid_dashboard') }}">Dashboard</a></li>
      </ul>
    </div>
    <div class="row">
     
      <div class="col-md-6 col-lg-4">
        <div class="widget-small primary coloured-icon"><i class="icon bi bi-download fs-1"></i>
          <div class="info">
            <h4>Total Pemasukan</h4>
            <p><b></b></p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="widget-small danger coloured-icon"><i class="icon bi bi-upload fs-1"></i>
          <div class="info">
            <h4>Total Pengeluaran</h4>
            <p><b></b></p>
          </div>
        </div>
      </div>

          
      <div class="col-md-6 col-lg-4">
        <div class="widget-small warning coloured-icon"><i class="icon bi bi-wallet fs-1"></i>
          <div class="info">
            <h4>Total Saldo</h4>
              
            <p><b></b></p>


          </div>
        </div>
      </div>




    
      
    <div class="row">
      <div class="col-md-6">
            <div id="salesChart"></div>
        
      </div>
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Pie Chart</h3>
          <div class="ratio ratio-16x9">
            <div id="supportRequestChart"></div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.7.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- Page specific javascripts-->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
  <script type="text/javascript">
    const salesData = {
      xAxis: {
        type: 'category',
        data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
      },
      yAxis: {
        type: 'value',
        axisLabel: {
          formatter: '${value}'
        }
      },
      series: [
        {
          data: [150, 230, 224, 218, 135, 147, 260],
          type: 'line',
          smooth: true
        }
      ],
      tooltip: {
        trigger: 'axis',
        formatter: "<b>{b0}:</b> ${c0}"
      }
    }
    
    const supportRequests = {
      tooltip: {
        trigger: 'item'
      },
      legend: {
        orient: 'vertical',
        left: 'left'
      },
      series: [
        {
          name: 'Support Requests',
          type: 'pie',
          radius: '50%',
          data: [
            { value: 10, name: 'Pemasukan' },
            { value: 20, name: 'Pengeluaran' },
            { value: 30, name: 'Saldo' }
          ],
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
          }
        }
      ]
    };
    
    const salesChartElement = document.getElementById('salesChart');
    const salesChart = echarts.init(salesChartElement, null, { renderer: 'svg' });
    salesChart.setOption(salesData);
    new ResizeObserver(() => salesChart.resize()).observe(salesChartElement);
    
    const supportChartElement = document.getElementById("supportRequestChart")
    const supportChart = echarts.init(supportChartElement, null, { renderer: 'svg' });
    supportChart.setOption(supportRequests);
    new ResizeObserver(() => supportChart.resize()).observe(supportChartElement);
  </script>
  <!-- Google analytics script-->
  <script type="text/javascript">
    if(document.location.hostname == 'pratikborsadiya.in') {
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-72504830-1', 'auto');
      ga('send', 'pageview');
    }
  </script>
</body>
</html>
  @endsection