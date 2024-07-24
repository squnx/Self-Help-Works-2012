function diet_calc(lang){
   // lang parameter is null for English or language code, e.g., ("es")
   var f = document.forms[0]; // "bmi_input" is 1st form
   var bm, i, fi, ii, i1, kg, htc, minbm, maxbm, m, bmix, j, o1,o2, m1;
   var calmin, calmax, metricsw, gpd;

  // Set up language variables:  msXXX
  if (lang=="es") {  // Spanish
    ms001 = "Por favor, introduzca su altura y peso.";
    ms002 = "Error en la altura.";
    ms003 = "Error en el peso.";
    ms004 = "Por favor, introduzca el tamaño de su cintura.";
    ms005 = "Error en el tamaño de la cintura.";
    ms006 = "Por favor, introduzca el tamaño de su cuello.";
    ms007 = "Error en el tamaño del cuello.";
    ms008 = "Por favor, indique Hombre o Mujer.";
    ms009 = "Por favor, introduzca el tamaño de su cadera.";
    ms010 = "Error en el tamaño de la cadera.";
    ms011 = "Por favor, indique su nivel de actividad.";
    ms012 = "Su peso está en el rango normal.";
    ms013 = "Usted no necesita perder peso.<br/>\n";
    ms014 = "Es posible que tenga que perder grasa abdominal.<br/>\n";
    ms015 = "Inicie un programa de ejercicio y aumente su actividad física.<br/>\n";
    ms016 = "Calorías mínimas necesarias: ";
    ms017 = " Calorías diarias<br/>\n";
    ms018 = "Su peso está ";
    ms019 = " kilogramos (";
    ms020 = " libras) bajo lo normal.<br/>\n";
    ms021 = "Es posible que tenga que aumentar su ingestión de calorías.<br/>\n";
    ms022 = "Consuma cuando menos ";
    ms023 = " calorías diarias.<br/>\n";
    ms024 = "Su Índice de Masa Corporal (IMC) excede lo normal, pero su proporcion de cintura a altura es normal.";
    ms025 = "Usted puede tener exceso de peso o una distribución peculiar de peso.<br/>\n";
    ms026 = "Usted tiene ";
    ms027 = " kilogramos (";
    ms028 = " libras) de sobrepeso.";
    ms029 = "Usted necesita hacer ejercicio cuando menos 30 minutos al día.<br/>\n"; 
    ms030 = "Limite su consumo alimenticio a ";
    ms031 = " para perder ";
    ms032 = " libras por mes.<br/>\n";
    ms033 = " Kg por mes.<br/>\n";
    ms034 = "Su dieta debe contener cuando menos ";
    ms035 = " gramos de proteína por día.<br/>\n"; 
    ms036 = "Error en las medidas.  Porcentaje de grasa corporal negativo.";
    kilogram = "kg";
    pound = "libras";
    meter = "m";
  }
  else if (lang=="ru") {  // Russian
    ms001 = "Введите свой рост и вес.";
    ms002 = "Ошибка в высоте.";
    ms003 = "Ошибка в весе.";
    ms004 = "Введите размер талии.";
    ms005 = "Ошибка в размере талии.";
    ms006 = "Введите размер шеи.";
    ms007 = "Ошибка в размере шеи.";
    ms008 = "Укажите мужчина или женщина";
    ms009 = "Введите размер бедер.";
    ms010 = "Ошибка в размере бедер.";
    ms011 = "Определите уровень деятельности ";
    ms012 = "Ваш вес находится в нормальном диапазоне.";
    ms013 = "Вам не надо похудеть.<br/>\n";
    ms014 = "Вы должны потерять некоторый брюшной жир.<br/>\n";
    ms015 = "Начинайте программу упражнения и станьте более активными.<br/>\n";
    ms016 = "Минимальные требования калорий: ";
    ms017 = " Калорий в день<br/>\n";
    ms018 = "Ваш вес менее чем нормален ";
    ms019 = " килограммы (";
    ms020 = " фунты).<br/>\n";
    ms021 = "Вы, возможно, должны увеличить ваше потребления калорий.<br/>\n";
    ms022 = "Потребляйте по крайней мере ";
    ms023 = " калорий в день.<br/>\n";
    ms024 = "Ваш ИМТ больше нормального, но ваше пропорция талии к высоте нормально.";
    ms025 = "У вас избыточный вес или у вас есть необычные массовые распространения.<br/>\n";
    ms026 = "У вас избыточный вес на ";
    ms027 = " килограммы (";
    ms028 = " фунты)";
    ms029 = "Вам необходимо физических упражнений не менее 30 минут каждый день.<br/>\n";
    ms030 = "Ограничьте потребление пищи на ";
    ms031 = " чтобы потерять ";
    ms032 = " фунтов в месяц.<br/>\n";
    ms033 = " Кг в месяц.<br/>\n";
    ms034 = "Ваша диета должна содержать, по крайней мере, ";
    ms035 = " грамм белка в день.<br/>\n";  
    ms036 = "Измерения неправильно. Процент жира является негативные.";
    kilogram = "кг";
    pound = "фунты";
    meter = "м";
  }
  else if (lang=="id") {  // Indonesian
    ms001 = "Silakan masukkan tinggi dan berat.";
    ms002 = "Kesalahan dalam tinggi.";
    ms003 = "Kesalahan dalam berat.";
    ms004 = "Silakan masukkan ukuran pinggang.";
    ms005 = "Kesalahan dalam ukuran pinggang.";
    ms006 = "Silakan masukkan ukuran leher.";
    ms007 = "Kesalahan dalam ukuran leher.";
    ms008 = "Silakan tentukan Pria atau Wanita";
    ms009 = "Silakan masukkan ukuran pinggul.";
    ms010 = "Kesalahan dalam ukuran pinggul.";
    ms011 = "Silakan masukkan Tingkat dari Aktivitas";
    ms012 = "Anda berat dalam rentang normal.";
    ms013 = "Anda tidak perlu menurunkan berat badan.<br/>\n";
    ms014 = "Anda mungkin perlu kehilangan lemak perut.<br/>\n";
    ms015 = "Memulai sebuah program latihan dan menjadi lebih aktif.<br/>\n";
    ms016 = "Jumlah kadar kalori persyaratan minimum: ";
    ms017 = " Kalori per hari<br/>\n";
    ms018 = "You are underweight by ";
    ms019 = " kilogram (";
    ms020 = " pounds).<br/>\n";
    ms021 = "Anda mungkin harus meningkatkan jumlah kadar kalori asupan.<br/>\n";
    ms022 = "Mengkonsumsi minimal ";
    ms023 = " kalori per hari.<br/>\n";
    ms024 = "Anda IMT lebih besar dari biasanya, tapi Anda pinggang-ke-tinggi rasio adalah normal.";
    ms025 = "Anda mungkin tidak biasa atau memiliki kelebihan berat massa distribusi.<br/>\n";
    ms026 = "Anda kegemukan oleh ";
    ms027 = " kilogram (";
    ms028 = " pounds)";
    ms029 = "Anda perlu latihan minimal 30 menit setiap hari.<br/>\n";
    ms030 = "Anda membatasi asupan makanan ke ";
    ms031 = " kehilangan ";
    ms032 = " pounds per bulan.<br/>\n";
    ms033 = " Kg per bulan.<br/>\n";
    ms034 = "Diet Anda harus mengandung setidaknya ";
    ms035 = " gram protein per hari.<br/>\n";  
    ms036 = "Kesalahan pengukuran. Persen lemak tubuh yang negatif.";
    kilogram = "kg";
    pound = "lb";
    meter = "m";
  }
  else {  // Default language: English
    ms001 = "Please enter your height and weight.";
    ms002 = "Error in height.";
    ms003 = "Error in weight.";
    ms004 = "Please enter your waist size.";
    ms005 = "Error in waist size.";
    ms006 = "Please enter your neck size.";
    ms007 = "Error in neck size.";
    ms008 = "Please specify Male or Female";
    ms009 = "Please enter your hip size.";
    ms010 = "Error in hip size.";
    ms011 = "Please specify Level of Activity";
    ms012 = "Your weight is in the normal range.";
    ms013 = "You do not need to lose weight.<br/>\n";
    ms014 = "You may need to lose some abdominal fat.<br/>\n";
    ms015 = "Start an exercise program and become more active.<br/>\n";
    ms016 = "Minimum caloric requirements: ";
    ms017 = " Calories per day<br/>\n";
    ms018 = "You are underweight by ";
    ms019 = " kilograms (";
    ms020 = " pounds).<br/>\n";
    ms021 = "You may need to increase your caloric intake.<br/>\n";
    ms022 = "Consume at least ";
    ms023 = " calories per day.<br/>\n";
    ms024 = "Your BMI is greater than normal, but your waist-to-height ratio is normal.";
    ms025 = "You may be overweight or have unusual mass distribution.<br/>\n";
    ms026 = "You are overweight by ";
    ms027 = " kilograms (";
    ms028 = " pounds)";
    ms029 = "You need to exercise at least 30 minutes every day.<br/>\n";
    ms030 = "Limit your food intake to ";
    ms031 = " to lose ";
    ms032 = " pounds per month.<br/>\n";
    ms033 = " Kg per month.<br/>\n";
    ms034 = "Your diet should contain at least ";
    ms035 = " grams of protein per day.<br/>\n";  
    ms036 = "Error in measurements. Percent body fat is negative.";
    kilogram = "kg";
    pound = "lb";
    meter = "m";
  }
  

  // assume metric
  kg = f.wtk.value;
  htc = parseFloat(f.htc.value);
  nkc = parseFloat(f.neckc.value);
  wac = parseFloat(f.waistc.value);
  hic = parseFloat(f.hipc.value);  
  metricsw = 1;
  if ((!chkw(kg)) || (!chkw(htc))) {  // not metric
   metricsw = 0;
   w = f.wt.value;
   v = f.htf.value;
   u = f.hti.value;

    // Validate fields to check for existence of values
    if (!chkw(u) || !chkw(v) || !chkw(w) ){
     alert(ms001);  // ms001 = "Please enter your height and weight.";
     return;
    }
    
    // Convert feet to inches
    ii = parseFloat(f.hti.value);
    fi = parseFloat(f.htf.value * 12);
    i = fi + ii;

    kg = w/2.2;    // convert pounds to kg
    htc = i*2.54;      // convert inches to cm

    nk = parseFloat(f.neck.value);
    nkc = nk*2.54;
    wa = parseFloat(f.waist.value);
    wac = wa*2.54;
    hi = parseFloat(f.hip.value);    
    hic = hi*2.54;
  }  // not metric
   
    if (htc < 100 || htc > 250) {     
     alert(ms002);  // ms002 = "Error in height.";
     return;
    }
    if (kg < 25 || kg > 250) {     
     alert(ms003);  // ms003 = "Error in weight.";
     return;
    }   
   m = htc/100;  // meters
   h2 = m * m;
   bm = kg/h2;
   bmix = rounder(bm);  // bmi rounded to tenths
   // display on form    
   document.getElementById('bmi').innerHTML=bmix+"&nbsp;&nbsp;"+kilogram+"/"+meter+"<sup>2</sup>";  
       
    if  (!chkw(wac))  {     // waist 
     alert(ms004);  // ms004 = "Please enter your waist size.";
     return;
    }        
    if (  wac < 45 || wac > htc) {     // waist should be smaller than height
     alert(ms005);  // ms005 = "Error in waist size.";
     return;
    }     
    
   w2h = (wac/htc) + 0.005;  // round to hundredths
   ii = w2h.toString();
   // display waist-to-height ratio  
   document.getElementById('wthr').innerHTML=ii.substring(0,4);  
   
    if (!chkw(nkc)) {     
     alert(ms006);  // ms006 = "Please enter your neck size.";
     return;
    }    
    if ( nkc < 20 || nkc > 53) {     
     alert(ms007);  // ms007 = "Error in neck size.";
     return;
    }    

   // check for radio buttons
   sex = " ";
   if (f.sex[0].checked) {
     sex = "m";
   }
   if (f.sex[1].checked) {
     sex = "f";
   }
   if (sex == " ") { 
     alert(ms008);  // ms008 = "Please specify Male or Female";
    return;
   }
  if (f.sex[1].checked) {
    if  (!chkw(hic)) {     
     alert(ms009);  // ms009 = "Please enter your hip size.";
     return;
    }   
    if ( hic < 45 || hic > 200) {     
     alert(ms010);  // ms010 = "Error in hip size.";
     return;
    }  
  }    

  logcon = Math.LN10;  // ln(10) = 2.302585093;  //  log10(x) = ln(x)/ln(10)
  if (sex == "m") { // male
    calmin = Math.floor(1842 + (htc-150)*15.4 + 0.5);
    calmax = Math.floor(2488 + (htc-150)*23.6 + 0.5);
    // compute % body fat
    i = 495/(1.0324 - 0.19077*(Math.log(wac-nkc)/logcon) + 0.15456*(Math.log(htc)/logcon) ) - 450;
  }
  else {  // female
    calmin = Math.floor(1622 + (htc-150)*13.2 + 0.5);
    calmax = Math.floor(2194 + (htc-150)*19.3 + 0.5);
    // compute % body fat
    i = 495/(1.29579 - 0.35004*(Math.log(wac+hic-nkc)/logcon) + 0.22100*(Math.log(htc)/logcon) ) - 450;  
  }
  ii = rounder(i); 
  if (ii < 0) {
    alert(ms036);  //    ms036 = "Error in measurements. Percent body fat is negative.";
  }
  document.getElementById('pctfat').innerHTML=ii+"%";
  
  // Lean body mass: lbm = wac * (100 - pctfat);
  ii = kg*((100 - i)/100);
  j = " "+kilogram;    
  if (metricsw === 0) {
    ii = ii*2.2;
    j = " "+pound;   
  }
  document.getElementById('leanbm').innerHTML=rounder(ii) + j;
  
   act = " ";
   gpd = 0.8;    // grams of protein per day
   if (f.act[0].checked) {
     act = "0";
     gpd = 0.8;
	 }
   if (f.act[1].checked) {
     act = "1";
     gpd = 1.1;
	 }
   if (f.act[2].checked) {
     act = "2";
     gpd = 1.4;
   }
  if (act == " ") { 
     alert(ms011);  // ms011 = "Please specify Level of Activity";
    return;
  }
   
   minbm = 18.5;
   maxbm = 24.9;
   ii = Math.floor(gpd * (maxbm * h2));   // (ideal high weight in Kg) * gpd = grams of protein per day
    
   o1=""; o2 = "";
   if ((bmix >= minbm) && (bmix  <= maxbm) ) {  // normal weight
    o1=ms012;  // ms012 = "Your weight is in the normal range.";
    if (w2h < 0.5) {
      o2 = ms013;  // ms013 = "You do not need to lose weight.<br/>\n";
    }
    else {
      o2 = ms014;  // ms014 = "You may need to lose some abdominal fat.<br/>\n";
    }
    if (act == "0"){
      o2 = o2 + ms015;  // ms015 = "Start an exercise program and become more active.<br/>\n";
    }
    //  ms016 = "Minimum caloric requirements: ";  //  ms017 = " Calories per day<br/>\n";
    o2 = o2 + ms016 + calmin + ms017;
   }  // normal weight
   else {  // not normal weight
    if (bmix < minbm) {  // underweight
     i = rounder(h2*minbm - kg);
     i1 = i*2.2;
     i1 = rounder(i1);
     //     ms018 = "You are underweight by "; ms019 = " kilograms (";  ms020 = " pounds).<br/>\n";
     o1 = ms018+i+ms019+i1+ms020;
     //  ms021 = "You may need to increase your caloric intake.<br/>\n";
     //  ms022 = "Consume at least ";  ms023 = " calories per day.<br/>\n";
     o2 = ms021;
     o2 = o2 + ms022 + calmin + ms023;
    } // underweight
    if (bmix > maxbm) {  // overweight
      if (w2h < 0.5) { // BMI > 24.9 && waist-to-height < 0.5 ==> bodybuilder
        //     ms024 = "Your BMI is greater than normal, but your waist-to-height ratio is normal.";
        //     ms025 = "You may be overweight or have unusual mass distribution.<br/>\n";
        o1 = ms024;
        o2 = ms025;
      }
      else { // w2h > 0.5
       i = rounder(kg - h2*maxbm);
       i1 = i*2.2;
       i1 = rounder(i1);
       //     ms026 = "You are overweight by ";  ms027 = " kilograms (";  ms028 = " pounds)";
       o1 = ms026+i+ms027+i1+ms028;
       if (act == "0"){
        o2 = ms029; // ms029 = "You need to exercise at least 30 minutes every day.<br/>\n";
       }
       //     ms016 = "Minimum caloric requirements: ";    ms017 = " Calories per day<br/>\n";
       o2 = o2 + ms016 + calmin + ms017;

       i = calmin * 0.15;
       v = Math.floor(calmin - i);
       // ms030 = "Limit your food intake to "; ms023 = " calories per day.<br/>\n";
       o2 = o2 + ms030 + v + ms023;
       if (metricsw === 0) {
        u = rounder( (i/4086) * 30);
        // ms031 = " to lose "; ms032 = " pounds per month.<br/>\n";  ms033 = " Kg per month.<br/>\n";
        o2 = o2 + ms031 + u + ms032;
       }
       else {
        u = rounder( ((i/4086) * 30)/2.2);
        o2 = o2 + ms031 + u + ms033; 
       }
      } // w2h > 0.5
    }  // overweight
   } // not normal weight
   //     ms034 = "Your diet should contain at least ";     ms035 = " grams of protein per day.<br/>\n";  
   o2 = o2 + ms034 + ii + ms035;   
   document.getElementById('out').innerHTML=o1;
   document.getElementById('out2').innerHTML=o2;
}  // diet_calc(lang)

function chkw(w){
   if (isNaN(parseFloat(w))){
      return false;
   } else if (w < 0){
    return false;
   }
   else{
    return true;
   } 
}

function rounder(x) {
  var x1;
   x = x + 0.05;  // round to tenths
   f_bmi = Math.floor(x);
   diff  = Math.floor((x - f_bmi)*10);
   x1 = f_bmi + "." + diff;
  return(x1);
}

function vclear(x) {
   var f = document.forms[0]; 
   if (x == 1){ // English units, clear metric
     f.htc.value = ""; f.neckc.value = ""; f.waistc.value = ""; f.hipc.value = "";
     f.wtk.value = "";
   }
   if (x == 2){  // Metric units, clear English units
     f.htf.value = ""; f.hti.value = "";  f.neck.value = ""; f.waist.value = ""; f.hip.value = "";
     f.wt.value = "";
   }   
   if (x == 3){  // male
     f.hip.value = ""; f.hipc.value = "";
   }      

   document.getElementById('bmi').innerHTML="&nbsp;";
   document.getElementById('wthr').innerHTML="&nbsp;";
   document.getElementById('pctfat').innerHTML="&nbsp;";
   document.getElementById('leanbm').innerHTML="&nbsp;";
   document.getElementById('out').innerHTML="&nbsp;";
   document.getElementById('out2').innerHTML="&nbsp;";
}