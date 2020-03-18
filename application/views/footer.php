<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2019 <a href="http://hotel.cihadoge.com/">Bakery Order System</a>. <span class="pull-right"></span> </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 

<script src="/js/jquery-1.7.2.min.js"></script> 
<script src="/js/excanvas.min.js"></script> 
<script src="/js/chart.min.js" type="text/javascript"></script> 
<script src="/js/bootstrap.js"></script>
<script src="/js/toastr/toastr.min.js"></script>
<script language="javascript" type="text/javascript" src="/js/full-calendar/fullcalendar.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.jqueryui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script src="/js/base.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script type="text/javascript">
  $('#btn-print').on('click', function(evt){
    $('.navbar').hide();
    $('.subnavbar-inner').hide();
    $('#btn-print').hide();
    print();
    $('.navbar').show();
    $('.subnavbar-inner').show();
    $('#btn-print').show();
  });
  function removeRow(item)
  {
    $(item).parents("tr").remove();
    calculator('table-content', 1, 9);
  }

  function load_order_data()
  {
    get_orderdata(0);
  }

  function is_product_exist(prodcutid)
  {
    table = document.getElementById('table-content');
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) 
    {
      if($(tr[i]).attr('proid') == prodcutid)
      {
        toastr.error('Already added product.');
        return true;
      }
    }
    return false;
  }
  function state_change(currow)
  {
    if(!confirm('Are you sure ?')) return;
    var orderid = $(currow).attr('orderid');
    //Status changed
    $.ajax({
        url : '/orderlist/state_change/' + orderid,
        type : 'POST',
        dataType:'text',
        success : function(data) {              
          if(data == 'ok')
          {
            toastr.success('The operation was successed.');            
            $(currow).attr('disabled', true);
            $(currow).text('COMPLETE');
            $(currow).attr('class','btn btn-small btn-success');
            } else {
            toastr.error('The operation was failed.');
          }
        },
        error : function(request,error)  
        {
            toastr.error("Request: "+JSON.stringify(request));
        }
      }); 

  } 

  function removeOrderRow(item)
  {
    $(item).parents("tr").remove();
    ordercalculator('table-content', 4,5);
  }
  
  function precise(x) {
    //return Number.parseFloat(x).toPrecision(3);
    return Number.parseFloat(x).toFixed(2);
  }

  function tablefilter(tableid, index, str)
  {
          var table, tr, td, i, txtValue;
          filter = str.toUpperCase();
          table = document.getElementById(tableid);
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[index];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                $(tr[i]).attr('ignor','false');
              } else {
                tr[i].style.display = "none";
                $(tr[i]).attr('ignor','true');
              }
          }       
      }
  }

  function btns_disabled()
  {
      $('#reset-cart').attr('disabled', true);
      $('#btn-order').attr('disabled', true);
      $('#add-item').attr('disabled', true);
  }

  function get_orderdata(orderid)
  {
      $('#reset-cart').attr('disabled', false);
      $('#btn-order').attr('disabled', false);
      $('#add-item').attr('disabled', false);
      $.ajax({
        url: '/order/get_order_data/' + orderid,
        type: 'POST',
        data:{userid:$('#userlist').val(), orderdate:$('#orderdate').val()},
        dataType: 'json',
        success : function(res)
        {
           $('#table-content').empty();
           $('#table-content').html(res.htmldata);
           $('#orderid').val(res.orderid);
           ordercalculator('table-content', 4,5);
           var state = res.state;
           if(state == 'COMPLETE')
           {
            toastr.error('This order is already completed.');
            btns_disabled();
           } else if(state == 'lastday_true')
           {
            toastr.error('The changed date is already finished.');
            btns_disabled();
           } else if(state == 'orderday_true')
           {
             //  toastr.error('Order data is not exists.');
               btns_disabled();
           } else if(state != 'PENDING' && state != '')
           {
              toastr.error(state);
              btns_disabled();
           }
        }
    });
  } 

  function get_order_sumery()
  {
    var userid = $('#userlist').val();
    var date_range = $('#order_date_range').val();
    var priceband = $('#userlist').find("option:selected").attr('priceband');
    $.post('/sumery/get_order_sumery', {userid: userid, date_range:date_range, priceband:priceband}, function(data, textStatus, xhr) 
    {
        var resval = JSON.parse(data);
        $('#sumery_table').DataTable().destroy();
        $('#sumery_content').html(resval.htmldata);
        $('#sumery_table').DataTable();
        $('#total-sum').text(resval.sumtotal);
    });
  }

  function get_order_sumery_print()
  {
    var dateString = $('#orderdate').val();
    var dateParts = dateString.split("/");
    // month is 0-based, that's why we need dataParts[1] - 1
    var options = {year: 'numeric', month: 'long', day: 'numeric' };
    var dateObject = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]); 
    $('#date_title').text(dateObject.toLocaleDateString("en-US", options));
    $.post('/sumery/get_order_sumery_print', {orderdate:dateString}, function(data, textStatus, xhr) 
    {
        var resval = JSON.parse(data);
        $('#table-content').empty();
        $('#table-content').html(resval.htmldata);
        $('#total-sum').text(resval.sumtotal);
        $('#customer_orders').empty();
        $('#customer_orders').html(resval.cushtml);
    });
  }


  function calculator(tableid, startindex, endindex)
  {
    var table = document.getElementById(tableid);
    var tr = table.getElementsByTagName("tr");
    var td, txtValue, sumval,sumprice;
    var price = 0;
    for(col = startindex; col <= endindex; col++)
    {
      sumval = 0;
      sumprice = 0;
      for (i = 0; i < tr.length; i++) 
      {
        if($(tr[i]).attr('ignor') == 'true') continue;
        price = parseFloat($(tr[i]).attr('price'));
        td = tr[i].getElementsByTagName("td")[col];
          if (td) {
            if(col > 0 && col < 8)
            {
              txtValue = td.firstChild.value;
              if(!txtValue) continue;
              sumval += parseFloat(txtValue);
            } else if(col == 8)
            {
              txtValue = $(td).text();
              sumval += parseFloat(txtValue);
            } else if(col == 9)
            {
              txtValue = $(td).attr('realval');
              sumval += parseFloat(txtValue); 
            }
          }
          sumprice += price*parseFloat(txtValue);
      } 
      if(col == 8)
        $('#persum_'+ col).text(sumval.toString());
      else if(col == 9)
        $('#persum_'+ col).text('$' + precise(sumval).toString());
      else if(col < 8)
        $('#persum_'+ col).text('$' + precise(sumprice).toString());
    } 
  }

  function sumcalculator(tableid, startindex, endindex)
  {
    var table = document.getElementById(tableid);
    var tr = table.getElementsByTagName("tr");
    var td, txtValue, sumval;
    var price = 0;
    for (row = 0; row < tr.length; row++) 
    {
      sumval = 0;
      if($(tr[row]).attr('ignor') == 'true') continue;
      price = parseFloat($(tr[row]).attr('price'));
      for(col = startindex; col <= endindex; col++)
      {
          td = tr[row].getElementsByTagName("td")[col];
          txtValue = td.firstChild.value;
          if(!txtValue) continue;
           sumval += parseFloat(txtValue);
      }
      tr[row].getElementsByTagName("td")[endindex + 1].innerText = sumval.toString();
      tr[row].getElementsByTagName("td")[endindex + 2].innerText ='$' + precise(price*sumval).toString();
      $(tr[row].getElementsByTagName("td")[endindex + 2]).attr('realval', precise(price*sumval).toString());
    }
    calculator('table-content', 1, 9);
  }

  function ordercalculator(tableid, startindex, endindex)
  {
      var table = document.getElementById(tableid);
      var tr = table.getElementsByTagName("tr");
      var td, txtValue, sumval;
      var price = 0;
      var sumval = 0;
        for (row = 0; row < tr.length; row++) 
        {
          price = parseFloat($(tr[row]).attr('price'));
          td = tr[row].getElementsByTagName("td")[startindex];
          txtValue = parseFloat(td.firstChild.value);
          tr[row].getElementsByTagName("td")[endindex].innerText ='$' + precise(price*txtValue).toString();
          $(tr[row].getElementsByTagName("td")[endindex]).attr('realval', precise(price*txtValue).toString());
          if($(tr[row]).attr('ignor') == 'true') continue;
            sumval += price*txtValue;  
        } 
       $('#total-sum').text(precise(sumval));
  }

  function savecart(tableid, name)
  {
    var table = document.getElementById(tableid);
    var tr = table.getElementsByTagName("tr");
    var customer_id = $('#userlist').val();
    if(tr.length == 0) 
    {
      toastr.error('There is no data to save.');
      return;
    }
    var cartlst = [];
    var cartitemlst = [];
    cartlst.push(name);
    var cartid = $('#cart-item').val()
    cartlst.push(customer_id);
    for(row = 0; row < tr.length; row++)
    {
      var cartitem = [];
      var productid = $(tr[row]).attr('proid');
      var price = $(tr[row]).attr('price');
      var realprice = $(tr[row]).attr('realprice');
      td = tr[row].getElementsByTagName("td")[4];
      var qty = parseInt(td.firstChild.value);
      var tax = tr[row].getElementsByTagName("td")[3].innerText;
      cartitem.push(productid);
      cartitem.push(price);
      cartitem.push(tax);
      cartitem.push(realprice);
      cartitem.push(qty);
      cartitemlst.push(cartitem);
   }
    //Save processing
    $.ajax({
        url : '/order/add_cart',
        type : 'POST',
        data : {'cartlst': JSON.stringify(cartlst),'cartitemlst':JSON.stringify(cartitemlst), 'customer_id':customer_id,'cartid':cartid},
        dataType:'text',
        success : function(data) {              
          if(data == 'ok')
          {
            toastr.success('The data were saved success.');            
            var priceband = $('#userlist').find("option:selected").attr('priceband'); //only time the find is required
            getorderitems(priceband);
            $('#cart-name').val('');
            } else {
            toastr.error('The data save failed.');
          }
        },
        error : function(request,error)  
        {
            toastr.error("Request: "+JSON.stringify(request));
        }
      }); 
  }

  function place_order(tableid, strdate)
  {
    var table = document.getElementById(tableid);
    var tr = table.getElementsByTagName("tr");
    var customer_id = $('#userlist').val();
    if(tr.length == 0) 
    {
      toastr.error('There is no data to save.');
      return;
    }
    var orderlst = [];
    var orderitemlst = [];
    orderlst.push(customer_id);
    orderlst.push(strdate);
    
    for(row = 0; row < tr.length; row++)
    {
      var orderitem = [];
      var productid = $(tr[row]).attr('proid');
      var price = $(tr[row]).attr('price');
      var realprice = $(tr[row]).attr('realprice');
      td = tr[row].getElementsByTagName("td")[4];
      var qty = parseInt(td.firstChild.value);
      var tax = tr[row].getElementsByTagName("td")[3].innerText;
      orderitem.push(productid);
      orderitem.push(price);
      orderitem.push(tax);
      orderitem.push(realprice);
      orderitem.push(qty);
      orderitemlst.push(orderitem);
   }
    var senddata = {'orderlst': JSON.stringify(orderlst),'orderitemlst':JSON.stringify(orderitemlst), 'customer_id':customer_id};
    <?php if(isset($orderdate)) {?>
        senddata = {'orderlst': JSON.stringify(orderlst),'orderitemlst':JSON.stringify(orderitemlst), 'customer_id':customer_id,'orderid':'<?=$orderid?>'};
    <?php } ?> 
    var jorderid = $('#orderid').val();
    if(jorderid != '0')
        senddata = {'orderlst': JSON.stringify(orderlst),'orderitemlst':JSON.stringify(orderitemlst), 'customer_id':customer_id,'orderid':jorderid};
    //Save processing
    $.ajax({
        url : '/order/place_order',
        type : 'POST',
        data : senddata,
        dataType:'text',
        success : function(data) {              
          if(data != '' && data != 'complete')
          {
            toastr.success('The data were saved success.');
            setTimeout(function(){ window.location.href = '/orderlist/view/'+ data; }, 2000);
          } else if(data == 'complete'){
            $('#btn-order').attr('disabled', true);
            toastr.error('Order Already completed.');
          } else {
            toastr.error('The data save failed.');
          }
        },
        error : function(request,error)  
        {
            toastr.error("Request: "+JSON.stringify(request));
        }
      }); 
  }

  function save_standing_orders(tableid, startindex, endindex)
  {
    var table = document.getElementById(tableid);
    var tr = table.getElementsByTagName("tr");
    var td, txtValue, sumval;
    var customer_id = $('#userlist').val();
    var itemlst = [];
    var item = [];
    var proid = 0;
    if(tr.length == 0) 
    {
      toastr.error('There is no data to save.');
      return;
    }
    for (row = 0; row < tr.length; row++) 
    {
      proid = $(tr[row]).attr('proid');
      var price = parseFloat($(tr[row]).attr('price'));
      var realprice = parseFloat($(tr[row]).attr('realprice'));
      item = [];
      item.push(customer_id);
      item.push(proid);
      item.push(price);
      item.push(realprice);
      for(col = startindex; col <= endindex; col++)
      {
          
          td = tr[row].getElementsByTagName("td")[col];
          txtValue = td.firstChild.value;
          if(!txtValue) txtValue = "0";
          item.push(txtValue);
      }
      itemlst.push(item);
    }
    //Saving processing....
     $.ajax({
        url : '/standing_order/save_data',
        type : 'POST',
        data : {'send-data': JSON.stringify(itemlst), 'customer_id':customer_id},
        dataType:'text',
        success : function(data) {              
          if(data == 'ok')
          {
            toastr.success('The data were saved success.');            
          } else {
            toastr.error('The data save failed.');
          }
        },
        error : function(request,error)  
        {
            toastr.error("Request: "+JSON.stringify(request));
        }
      }); 
  }

  function getitems(priceband) 
  {
      $.ajax({
        url : '/standing_order/ajax_get_itemlist/' + priceband,
        type : 'POST',
        dataType:'text',
        success : function(data) {              
          $('#product-item').empty();
          $('#product-item').html(data);
          var userid = $('#userlist').val()
          $.ajax({
            url: '/standing_order/ajax_get_order_data/' + userid,
            type: 'POST',
            dataType: 'text',
            success : function(res)
            {
               $('#table-content').empty();
               $('#table-content').html(res);
               sumcalculator('table-content',1,7); 
            }
          });
        },
        error : function(request,error)
        {
            toastr.error("Request: "+JSON.stringify(request));
        }
      });
  }

  function getorderitems(priceband) 
  {
      $.ajax({
        url : '/standing_order/ajax_get_itemlist/' + priceband,
        type : 'POST',
        dataType:'text',
        success : function(data) {              
          $('#product-item').empty();
          $('#product-item').html(data);
          var userid = $('#userlist').val();
          //load_order_data();
          // $.ajax({
          //   url: '/order/ajax_get_order_data/' + userid,
          //   type: 'POST',
          //   dataType: 'JSON',
          //   success : function(res)
          //   {
          //     $('#cart-item').empty();
          //     $('#cart-item').html(res.cartlst);
          //     // $('#table-content').empty();
          //      //$('#table-content').html(res);
          //      //sumcalculator('table-content',2,8); 
          //   }
          // });
        },
        error : function(request,error)
        {
            toastr.error("Request: "+JSON.stringify(request));
        }
      });
  }
</script>

<?php
  if($page == "address")
  { ?>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#address_table').DataTable();
      } );
    </script>
<?php }
?>

<?php
  if($page == "orderlist")
  { ?>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#orderlist_table').DataTable();
      });
    </script>
<?php }
?>

<?php
  if($page == "printsumery")
  { ?>
    <script type="text/javascript">
      $(document).ready(function() {
       $('#orderdate').datepicker();
      $( "#orderdate" ).datepicker( "option", "dateFormat", 'dd/mm/yy' );
      $('#orderdate').datepicker('setDate', 'today');
      } );
      setTimeout(function(){ get_order_sumery_print(); }, 100);
      $('#orderdate').on('change', function(evt)
      {
        get_order_sumery_print();
      });

    </script>
<?php }
?>





<?php
  if($page == "sumery")
  { ?>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#userlist').select2();
      $('#sumery_table').DataTable();
      $('#order_date_range').daterangepicker({
          startDate: moment().startOf('hour').add(-168, 'hour'),
          endDate: moment().startOf('hour').add(+168,'hour'),
          locale: {
          format: 'DD/MM/YYYY'}
        });
      get_order_sumery(); 
      
      $('#order_date_range').on('change', function(evt)
      {
        get_order_sumery();
      });

      $('#userlist').on('change', function(evt)
      {
         get_order_sumery(); 
      });

  });
    </script>
<?php }
?>





<?php
  if($page == "standing_order")
  { ?>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#product-item').select2();
        $('#userlist').select2();
        var priceband = $('#userlist').find("option:selected").attr('priceband'); //only time the find is required
        getitems(priceband);
        $('#stand-additem').on('click', function(event)
        {
            var flag = false;
            var insertweek;
            var sumprice = 0;
            var sumtotal = 0;
            var selitem = $("#product-item option:selected");
            var price = selitem.attr('price');
            var realprice = selitem.attr('realprice');
            if(is_product_exist($('#product-item').val())) return;
            for(var index = 1; index < 8; index++)
            {
              if($('#week_' + index).val() != '')
              {
                flag = true;
                sumtotal += parseInt($('#week_' + index).val());
                sumprice += parseFloat($('#week_' + index).val()) * parseFloat(price);
              }
              var curval = parseInt($('#week_' + index).val());  
              insertweek += `<td><input min="0" type="number" index = '${index}' value='${curval}' style="width: 50px;" onchange="javascript:sumcalculator('table-content',1,7);"/></td>`;
            }
            if(!flag)
            {
              toastr.error("You must be input at least one field.");
              $('#week_1').focus();
              return;
            }
            // Add item processing
            var proid = selitem.val();
            var groname = selitem.attr('groupname');
            var proname = selitem.attr('proname');
            var inserthtml = `<tr proid="${proid}" price="${price}" realprice="${realprice}">
                                <td proname>${proname}</td>
                                ${insertweek}
                                <td>${sumtotal}</td>
                                <td realval='${precise(sumprice)}'>$${precise(sumprice)}</td>
                                <td><button onclick="javascript:removeRow(this)" class="btn btn-danger btn-small"><i class="btn-icon-only icon-trash"> </i></button></td>  
                           </tr>`;
            $('#table-content').append(inserthtml);                          
            calculator('table-content', 1, 9);
        });

      $("#userlist").on('change', function(e)
      {
        var val = $(e.target).val();
        var priceband = $(e.target).find("option:selected").attr('priceband'); //only time the find is required
        getitems(priceband);
      });

      $('#stand-btnsave').on('click', function(evt)
      {
        save_standing_orders('table-content',1, 7);
      });

      $("#find-group").on("keyup", function() 
      {
          tablefilter('table-content', 0, $(this).val());  
          calculator('table-content', 1, 9);
      });

      $("#find-product").on("keyup", function() 
      {
          tablefilter('table-content', 1, $(this).val());
          calculator('table-content', 1, 9);
      });
      });
    </script>
<?php }
?>

<?php 
if($page == "order"){ ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#product-item').select2();
      $('#userlist').select2();
      var priceband = $('#userlist').find("option:selected").attr('priceband'); //only time the find is required
      getorderitems(priceband);
      $('#orderdate').datepicker();
      $( "#orderdate" ).datepicker( "option", "dateFormat", 'dd/mm/yy' );
      <?php if(!isset($orderdate)) { ?>
        $('#orderdate').datepicker('setDate', 'today');
        get_orderdata(0);
      <?php } else  { ?>
        $('#orderdate').val('<?=$orderdate?>');
        get_orderdata('<?=$orderid?>');
      <?php } ?> 
      $('#userlist').on('change', function(e)
      { 
          var val = $(e.target).val();
          var priceband = $(e.target).find("option:selected").attr('priceband'); //only time the find is required
          getorderitems(priceband);
          load_order_data();
      });

      $('#orderdate').on('change', function(e)
      {
          load_order_data();
      });


      $('#remove-cart').on('click', function()
      {
         var cartid = $('#cart-item').val();
         if(cartid == '0') return;
         if(!confirm('Are you sure ?')) return;
         $.ajax({
            url: '/order/remove_cart/' + cartid,
            type: 'POST',
            dataType: 'text',
            success : function(res)
            {
               var priceband = $('#userlist').find("option:selected").attr('priceband'); //only time the find is required
               getorderitems(priceband);
               ordercalculator('table-content', 4,5);
               toastr.success('The Cart remove successed.');
               $('#table-content').empty();   
            }
          });   
      });

      $('#reset-cart').on('click', function()
      {
         var orderid = $('#orderid').val();
         if(orderid == '0') return;
         if(!confirm('Are you sure ?')) return;
         $.ajax({
            url: '/order/reset_cart/' + orderid,
            type: 'POST',
            dataType: 'text',
            success : function(res)
            {
               if(res == 'ok')
               {
                  var priceband = $('#userlist').find("option:selected").attr('priceband'); //only time the find is required
                  getorderitems(priceband);
                  ordercalculator('table-content', 4,5);
                  toastr.success('The cart reset successed.');
                  $('#table-content').empty();    
               }  else {
                  toastr.error('The cart reset failed.');
               }
            }
          });   
      });

      $('#cart-item').on('change', function(e)
      { 
          cartid = $('#cart-item').val();
          if(cartid == 0) 
          {
            $('#remove-cart').hide();
            $('#table-content').empty();
            return;
          }
          $('#remove-cart').show();
          $.ajax({
            url: '/order/get_cart_data/' + cartid,
            type: 'POST',
            dataType: 'text',
            success : function(res)
            {
               $('#table-content').empty();
               $('#table-content').html(res);
               ordercalculator('table-content', 4,5);
            }
          });
      });

      $('#add-cart').on('click', function(evt)
      {
          if($('#cart-name').val() == '')
          {
            toastr.error('Input the cart name.');
            $('#cart-name').focus();
            return;
          }
          //Table processing...
          savecart('table-content', $('#cart-name').val());
      });

      $('#btn-order').on('click', function(evt)
      {
         if(!confirm('Are you sure ?')) return;
         place_order('table-content', $('#orderdate').val());

      });


      $("#find-group").on("keyup", function() 
      {
          tablefilter('table-content', 0, $(this).val());  
          ordercalculator('table-content', 4,5);
      });

      $("#find-product").on("keyup", function() 
      {
          tablefilter('table-content', 1, $(this).val());
          ordercalculator('table-content', 4,5);
      });
    
      $('#add-item').on('click', function(evt)
      {
          if(is_product_exist($('#product-item').val())) return;
          var realprice = 0.00, tax = 0.00;
          var selitem = $("#product-item option:selected");
          var price = parseFloat(selitem.attr('price'));
          realprice = parseFloat(selitem.attr('realprice'));
          var percent = '0.0%';
          if(selitem.attr('gst') == 1)
          {
            tax = precise(price * 0.1);
            percent = '0.1%';

          }
         // Add item processing
         var curval = parseInt($('#count').val());
         if($('#count').val() == '')
         {
            toastr.error("You must be input Quantity.");
            $('#count').focus();
            return;
         }

         var proid = selitem.val();
         var groname = selitem.attr('groupname');
         var proname = selitem.attr('proname');
         var inserthtml = `<tr proid="${proid}" price="${price}" realprice="${realprice}">
                                <td groupname style='display:none;'>${groname}</td>
                                <td proname>${proname}</td>
                                <td>$${realprice}</td>
                                <td>$${tax} (${percent})</td>
                                <td><input min="0" type="number" value='${curval}' style="width: 50px;" onchange="javascript:ordercalculator('table-content',4,5);"/></td>
                                <td></td>
                                <td><button onclick="javascript:removeOrderRow(this)" class="btn btn-danger btn-small"><i class="btn-icon-only icon-trash"> </i></button></td>  
                           </tr>`;
          $('#table-content').append(inserthtml);    
          ordercalculator('table-content', 4,5);
      });
    });  
</script>
<?php } ?>

<?php
  if($page == "holiday")
  { ?>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#userlist').select2();
      $('#holiday_table').DataTable();
      $('#date_range').daterangepicker({
          locale: {
          format: 'DD/MM/YYYY'
    }
  });
       });
    </script>
<?php }
?>

<?php
  if($page == "employee")
  { ?>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#usertable').DataTable();
      } );
    </script>
<?php }
?>

<?php
  if($page == "product")
  { ?>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#product_table').DataTable();
      $.fn.editable.defaults.mode = 'inline';
      $('#product_table td.price_val').editable({
          url: '/product/change_value/',
          pk: 123,
          type: 'number', 
          step:0.01,
           params: function (params) {
            var data = params;
            data.sendid = $(this).parent().attr("id");
            data.filedname = $(this).attr('filedname');
            return data;
          }
        });
      } );
    </script>
<?php }
?>

<?php
  if($page == "product_group")
  { ?>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#group_table').DataTable();
      } );
    </script>
<?php } ?>
 
<?php
if($page == "reservation" ) {
?>
<script type="text/javascript">
  function date2str(date) {
    var d = date.getDate(); 
    var m = date.getMonth()+1;
    var y = date.getFullYear();
    if(d<10)d='0'+d;
    if(m<10)m='0'+m;
    return y+'-'+m+'-'+d;
  }
  $(document).ready(function() {
    var d = new Date();
    if($("#calendar").length>0) {
      $("#checkin_date").val(date2str(d));
      $('#checkout_date').val(date2str(d));
    }
    var calendar = $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month'
      },
      selectable: true,
      selectHelper: true,
      select: function(start, end, allDay) {
        console.log(typeof start);
        var d = new Date(start);
        console.log(d.getDate());
        console.log(date2str(start));console.log(date2str(end));
        $('#checkin_date').val(date2str(start));
        $('#checkout_date').val(date2str(end));
//        window.location.href="/reservation/make/" + year + "/" + month + "/" + day;
        return;
        var title = prompt('Event Title:');
        if (title) {
          calendar.fullCalendar('renderEvent',
            {
              title: title,
              start: start,
              end: end,
              allDay: allDay
            },
            true // make the event "stick"
          );
        }
        calendar.fullCalendar('unselect');
      },
      editable: false,
      events: [
      ]
    });
    /*$('#calendar').find('.fc-widget-content').css('background-color','rgb(198, 247, 198)');
    $('#calendar').find('.fc-other-month').css('background-color','transparent');*/
  });

</script>
<?php } else if($page == "dashboard") { ?>

<script>     
  // init calendar
  $(document).ready(function() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var calendar = $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month'
      },
      selectable: true,
      selectHelper: true,
      select: function(start, end, allDay) {
        return;
        var title = prompt('Event Title:');
        if (title) {
          calendar.fullCalendar('renderEvent',
            {
              title: title,
              start: start,
              end: end,
              allDay: allDay
            },
            true // make the event "stick"
          );
        }
        calendar.fullCalendar('unselect');
      },
      editable: true,
      events: [
        {
          title: 'New Year',
          start: new Date(y, m, 1)
        },
        {
          title: 'Project Demo',
          start: new Date(y, m, 2)
        },
        {
          title: 'CS353 Final',
          start: new Date(y, m, 8)
        }
      ]
    });
    /*$('#calendar').find('.fc-widget-content').css('background-color','rgb(198, 247, 198)');
    $('#calendar').find('.fc-other-month').css('background-color','transparent');*/
  });

        var lineChartData = {
            labels: <?php echo json_encode($next_week_freq['dates']);?>,
            datasets: [
        /*{
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            data: [65, 59, 90, 81, 56, 55, 40]
        },*/
        {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            data: <?php echo json_encode($next_week_freq['freq_counts']);?>
        }
      ]

        }

        var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);


        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
        {
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,1)",
            data: [65, 59, 90, 81, 56, 55, 40]
        },
        {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 96, 27, 100]
        }
      ]

        }    

    </script><!-- /Calendar -->
    <!-- Welcome Guide -->
    <?php
    if(SHOW_GUIDE) {
    ?>
    <script src="js/guidely/guidely.min.js"></script>

    <script>
    $(function () {
      
      guidely.add ({
        attachTo: '#target-1'
        , anchor: 'top-left'
        , title: 'Today \'s Stats'
        , text: 'You can see how many services are registered today. We used stored procedure here.'
      });
      
      guidely.add ({
        attachTo: '#target-2'
        , anchor: 'top-left'
        , title: 'Next Week Reservations Chart'
        , text: 'You can see next week\'s hotel situation. It shows how many customers will be hosted next week.'
      });

      guidely.add ({
        attachTo: '#target-3'
        , anchor: 'top-left'
        , title: 'Most Favorite Customer'
        , text: 'Here, you can see the customer who spend most money to our hotel. We used MAX, SUM, GROUP BY functions on our database.'
      });
      
      
      guidely.add ({
        attachTo: '#target-4'
        , anchor: 'top-left'
        , title: 'Most Frequent Customers'
        , text: 'Here, you can see most visited customers. We used GROUP BY, ORDER functions here.'
      });
      
      guidely.init ({ welcome: true, startTrigger: true });


    });

    </script>
    <?php } ?>
    <!--/Welcome Guide-->
<?php } ?>
    <style type="text/css">
    .calendar{-webkit-user-select: none; -moz-user-select: none;}
    </style>
<script type="text/javascript">
  function open_form()
  {
    console.log("Opening Form...");
    $('#form').fadeIn();
  }

</script>
</body>
</html>
