function preventDefault(event){
     if(event.preventDefault){//判断对象方法是否存在时,要将方法当做属性来判断[函数名后不加小括号:if(对象.方法函数)],很多方法没有返回值,即使有返回值也不一定是布尔值,如果是if(方法函数())时会出现不可预料的结果
          event.preventDefault(); //非IE方法处理
     }else{
          event.returnValue=false; //IE方法处理
     }
}

function stopPropagation(event){
     if(event.stopPropagation){ //event.stopPropagation:以属性的形式进行判断
          event.stopPropagation(); //非IE方法处理
     }else{
          event.cancelBubble=true; //IE方法处理
     }
}