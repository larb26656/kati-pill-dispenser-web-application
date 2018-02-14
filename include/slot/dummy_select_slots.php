<style type="text/css">
.flip {
  -webkit-perspective: 800;   
          perspective: 800;
        position: relative;
        text-align: center;
}
.flip .card.flipped {
  -webkit-transform: rotatey(-180deg);
          transform: rotatey(-180deg);
}
.flip .card {
    width: 100%;
    height: 320px;
    -webkit-transform-style: preserve-3d;
    -webkit-transition: 0.5s;
    transform-style: preserve-3d;
    transition: 0.5s;
    background-color : transparent;

   
}
.flip .card .face {
  -webkit-backface-visibility: hidden ;
    backface-visibility: hidden ;
   z-index: 2;
}
.flip .card .front {
   position: absolute;
   width: 100%;
   z-index: 1;
}
.flip .card .img {
   position: relaitve;
   width: 100%;
   height: 320px;
   z-index: 1;
   border: 2px solid #000;
}
.flip .card .back {
  padding-top: 10%;
  -webkit-transform: rotatey(-180deg);
          transform: rotatey(-180deg);
}
  .inner{margin:0px !important;}

  .slot_info{
        font-family: 'Pridi', serif;
}
</style>
  <div class="row">
    <div class="col-md-3">
    <div class="flip">
        <div class="card"> 
          <div class="face front"> 
            <div class="inner">   
              <div class="panel panel-default slot_info">
                <div class="panel-heading" style="background-color: #FF8C7C;color: #FFFFFF;">
                  <center>
                  <p>
                  <h4>
                  ช่องจ่ายยาที่ 1
                  </h4>
                  </p>
                  <img src="pic/slot/pill.png" weight="150px" height="150px" class="img-circle">
                  <p>
                  <h4>
                  จำนวนยา 4/16 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  </h4>
                  </p>
                  </center>
                  
                </div>
                <div class="panel-body">ยาแก้ปวดหัว</div>
              </div>
            </div>
          </div> 
          <div class="face back"> 
            <div class="inner text-center"> 
                  <div class="panel panel-default">
                    <div class="panel-heading">รายละเอียดยา</div>
                    <div class="panel-body"><p>ใช้แก้ปวดหัว ทานครั้งละ 2 เม็ด</p>
                    <p>** ยากใกล้หมดแล้ว</p>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">แก้ไขช่องจ่ายยา</button></div>
                  </div>
            </div>
          </div>
        </div>   
      </div>
    
    </div>
     <div class="col-md-3">
    <div class="flip">
        <div class="card"> 
          <div class="face front"> 
            <div class="inner">   
              <div class="panel panel-default slot_info">
                <div class="panel-heading bg-slot1" style="background-color: #FF7CB8;color: #FFFFFF;">
                  <center>
                  <p>
                  <h4>
                  ช่องจ่ายยาที่ 2
                  </h4>
                  </p>
                  <img src="pic/slot/pill.png" weight="150px" height="150px" class="img-circle">
                  <p>
                  <h4>
                  จำนวนยา 16/16
                  </h4>
                  </p>
                  </center>
                  
                </div>
                <div class="panel-body">ยาแก้ปวดหัว</div>
              </div>
            </div>
          </div> 
          <div class="face back"> 
            <div class="inner text-center"> 
                  <div class="panel panel-default">
                    <div class="panel-heading">รายละเอียดยา</div>
                    <div class="panel-body"><p>ใช้แก้ปวดหัว ทานครั้งละ 2 เม็ด</p>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">แก้ไขช่องจ่ายยา</button></div>
                  </div>
            </div>
          </div>
        </div>   
      </div>
    
    </div>
     <div class="col-md-3">
    <div class="flip">
        <div class="card"> 
          <div class="face front"> 
            <div class="inner">   
              <div class="panel panel-default slot_info">
                <div class="panel-heading bg-slot1" style="background-color: #BE90D4;color: #FFFFFF;">
                  <center>
                  <p>
                  <h4>
                  ช่องจ่ายยาที่ 3
                  </h4>
                  </p>
                  <img src="pic/slot/pill.png" weight="150px" height="150px" class="img-circle">
                   <p>
                  <h4>
                  จำนวนยา 15/16
                  </h4>
                  </p>
                  </center>
                  
                </div>
                <div class="panel-body">ยาแก้ปวดหัว</div>
              </div>
            </div>
          </div> 
          <div class="face back"> 
            <div class="inner text-center"> 
                  <div class="panel panel-default">
                    <div class="panel-heading">รายละเอียดยา</div>
                    <div class="panel-body"><p>ใช้แก้ปวดหัว ทานครั้งละ 2 เม็ด</p>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">แก้ไขช่องจ่ายยา</button></div>
                  </div>
            </div>
          </div>
        </div>   
      </div>
    
    </div>
     <div class="col-md-3">
    <div class="flip">
        <div class="card"> 
          <div class="face front"> 
            <div class="inner">   
              <div class="panel panel-default slot_info">
                <div class="panel-heading bg-slot1" style="background-color: #22A7F0;color: #FFFFFF;">
                  <center>
                  <p>
                  <h4>
                  ช่องจ่ายยาที่ 4
                  </h4>
                  </p>
                  <img src="pic/slot/pill.png" weight="150px" height="150px" class="img-circle">
                   <p>
                  <h4>
                  จำนวนยา 7/16
                  </h4>
                  </p>
                  </center>
                  
                </div>
                <div class="panel-body">ยาแก้ปวดหัว</div>
              </div>
            </div>
          </div> 
          <div class="face back"> 
            <div class="inner text-center"> 
                  <div class="panel panel-default">
                    <div class="panel-heading">รายละเอียดยา</div>
                    <div class="panel-body"><p>ใช้แก้ปวดหัว ทานครั้งละ 2 เม็ด</p>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">แก้ไขช่องจ่ายยา</button></div>
                  </div>
            </div>
          </div>
        </div>   
      </div>
    
    </div>
  </div>
  <div class="row">
   <div class="col-md-3">
    <div class="flip">
        <div class="card"> 
          <div class="face front"> 
            <div class="inner">   
              <div class="panel panel-default slot_info">
                <div class="panel-heading bg-slot1" style="background-color: #47EBE0;color: #FFFFFF;">
                  <center>
                  <p>
                  <h4>
                  ช่องจ่ายยาที่ 5
                  </h4>
                  </p>
                  <img src="pic/slot/pill.png" weight="150px" height="150px" class="img-circle">
                   <p>
                  <h4>
                  จำนวนยา 15/16
                  </h4>
                  </p>
                  </center>
                  
                </div>
                <div class="panel-body">ยาแก้ปวดหัว</div>
              </div>
            </div>
          </div> 
          <div class="face back"> 
            <div class="inner text-center"> 
                  <div class="panel panel-default">
                    <div class="panel-heading">รายละเอียดยา</div>
                    <div class="panel-body"><p>ใช้แก้ปวดหัว ทานครั้งละ 2 เม็ด</p>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">แก้ไขช่องจ่ายยา</button></div>
                  </div>
            </div>
          </div>
        </div>   
      </div>
    
    </div>
     <div class="col-md-3">
    <div class="flip">
        <div class="card"> 
          <div class="face front"> 
            <div class="inner">   
              <div class="panel panel-default slot_info">
                <div class="panel-heading bg-slot1" style="background-color: #4EEC91;color: #FFFFFF;">
                  <center>
                  <p>
                  <h4>
                  ช่องจ่ายยาที่ 6
                  </h4>
                  </p>
                  <img src="pic/slot/pill.png" weight="150px" height="150px" class="img-circle">
                   <p>
                  <h4>
                  จำนวนยา 16/16
                  </h4>
                  </p>
                  </center>
                  
                </div>
                <div class="panel-body">ยาแก้ปวดหัว</div>
              </div>
            </div>
          </div> 
          <div class="face back"> 
            <div class="inner text-center"> 
                  <div class="panel panel-default">
                    <div class="panel-heading">รายละเอียดยา</div>
                    <div class="panel-body"><p>ใช้แก้ปวดหัว ทานครั้งละ 2 เม็ด</p>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">แก้ไขช่องจ่ายยา</button></div>
                  </div>
            </div>
          </div>
        </div>   
      </div>
    
    </div>
     <div class="col-md-3">
    <div class="flip">
        <div class="card"> 
          <div class="face front"> 
            <div class="inner">   
              <div class="panel panel-default slot_info">
                <div class="panel-heading bg-slot1" style="background-color: #F9BF3B;color: #FFFFFF;">
                  <center>
                  <p>
                  <h4>
                  ช่องจ่ายยาที่ 7
                  </h4>
                  </p>
                  <img src="pic/slot/pill.png" weight="150px" height="150px" class="img-circle">
                   <p>
                  <h4>
                  จำนวนยา 14/16
                  </h4>
                  </p>
                  </center>
                  
                </div>
                <div class="panel-body">ยาแก้ปวดหัว</div>
              </div>
            </div>
          </div> 
          <div class="face back"> 
            <div class="inner text-center"> 
                  <div class="panel panel-default">
                    <div class="panel-heading">รายละเอียดยา</div>
                    <div class="panel-body"><p>ใช้แก้ปวดหัว ทานครั้งละ 2 เม็ด</p>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">แก้ไขช่องจ่ายยา</button>
                    </div>
                  </div>
            </div>
          </div>
        </div>   
      </div>
    
    </div>
     <div class="col-md-3">
    <div class="flip">
        <div class="card"> 
          <div class="face front"> 
            <div class="inner">   
              <div class="panel panel-default slot_info">
                <div class="panel-heading bg-slot1" style="background-color: #8E5C3B;color: #FFFFFF;">
                  <center>
                  <p>
                  <h4>
                  ช่องจ่ายยาที่ 8
                  </h4>
                  </p>
                  <img src="pic/slot/pill.png" weight="150px" height="150px" class="img-circle">
                   <p>
                  <h4>
                  จำนวนยา 10/16
                  </h4>
                  </p>
                  </center>
                  
                </div>
                <div class="panel-body">ยาแก้ปวดหัว</div>
              </div>
            </div>
          </div> 
          <div class="face back"> 
            <div class="inner text-center"> 
                  <div class="panel panel-default">
                    <div class="panel-heading">รายละเอียดยา</div>
                    <div class="panel-body"><p>ใช้แก้ปวดหัว ทานครั้งละ 2 เม็ด</p>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">แก้ไขช่องจ่ายยา</button></div>
                  </div>
            </div>
          </div>
        </div>   
      </div>
    
    </div>
  </div>
<script type="text/javascript">
  $('.flip').hover(function(){
        $(this).find('.card').toggleClass('flipped');

    });
</script>