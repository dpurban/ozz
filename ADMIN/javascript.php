<!--   Core JS Files   -->
<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
<script type="text/javascript" src="assets/js/code39.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
  function get_object(id) {
   var object = null;
   if (document.layers) {
    object = document.layers[id];
   } else if (document.all) {
    object = document.all[id];
   } else if (document.getElementById) {
    object = document.getElementById(id);
   }
   return object;
  }
get_object("inputdata").innerHTML=DrawCode39Barcode(get_object("inputdata").innerHTML);
/* ]]> */
</script>

<!--    datetimepickerjs     -->
<script type="text/javascript" src="assets/js/bootstrap-material-datetimepicker.js"></script>
<script>
$(document).ready(function()
{
  $('#date').bootstrapMaterialDatePicker
  ({
    time: false,
    clearButton: true
  });

  $('#time').bootstrapMaterialDatePicker
  ({
    date: false,
    shortTime: false,
    format: 'HH:mm'
  });

  $('#date-format').bootstrapMaterialDatePicker
  ({
    format: 'dddd DD MMMM YYYY - HH:mm'
  });
  $('#date-fr').bootstrapMaterialDatePicker
  ({
    format: 'DD/MM/YYYY HH:mm',
    lang: 'fr',
    weekStart: 1, 
    cancelText : 'ANNULER',
    nowButton : true,
    switchOnClick : true
  });

  $('#date-end').bootstrapMaterialDatePicker
  ({
    weekStart: 0, format: 'DD/MM/YYYY HH:mm'
  });
  $('#date-start').bootstrapMaterialDatePicker
  ({
    weekStart: 0, format: 'DD/MM/YYYY HH:mm', shortTime : true
  }).on('change', function(e, date)
  {
    $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
  });

  $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });

  $.material.init()
});
</script>
<script>
  (function(i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function() {
      (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
      m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
  })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

  ga('create', 'UA-60343429-1', 'auto');
  ga('send', 'pageview');
</script>





