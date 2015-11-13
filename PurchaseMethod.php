<div id="PurchaseMethod" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
	
      <form class="contact" id="BuyProductForm" action="process.php" method="POST"><h3 class=form-signin-heading>請選擇購買方式</h3>
  <div id="product">
	  <input id="ActionID" name="ActionID" type="hidden" />
	  </div>
	  <label>購買方式(一): <input type="radio" name="optradio" id="rdoGetTicket" checked=true>取得優惠卷</label> </br>
<label>購買方式(二): <input type="radio" name="optradio" id="rdoLinePay">LinePay付款</label> </br>
</br></br>
<button class="btn btn-lg btn-success btn-block" type=submit id="btnPayMethodOK">確定</button>

</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>