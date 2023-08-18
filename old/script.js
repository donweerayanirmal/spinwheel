/* --------------- Spin Wheel  --------------------- */
const spinWheel = document.getElementById("spinWheel");
const spinBtn = document.getElementById("spin_btn");
const text = document.getElementById("text");
/* --------------- Minimum And Maximum Angle For A value  --------------------- */

/*
const spinValues = [
  { minDegree: 61, maxDegree: 90, value: 'L' },
  { minDegree: 31, maxDegree: 60, value: 'L' },
  { minDegree: 0, maxDegree: 30, value: 'L' },
  { minDegree: 331, maxDegree: 360, value: 'Air Pod' },
  { minDegree: 301, maxDegree: 330, value: 'L' },
  { minDegree: 271, maxDegree: 300, value: 'Voucher 1' },
  { minDegree: 241, maxDegree: 270, value: 'L' },
  { minDegree: 211, maxDegree: 240, value: 'Voucher 2' },
  { minDegree: 181, maxDegree: 210, value: 'L' },
  { minDegree: 151, maxDegree: 180, value: 'Voucher 3' },
  { minDegree: 121, maxDegree: 150, value: 'L' },
  { minDegree: 91, maxDegree: 120, value: 'Voucher 4' },
];

*/

const spinValues = [
  { minDegree: 61, maxDegree: 90, value: 'L' },
  { minDegree: 31, maxDegree: 60, value: 'Voucher 2' },
  { minDegree: 0,  maxDegree: 30, value: 'Voucher 4' },
  { minDegree: 331, maxDegree: 360, value: 'Air Pod' },
  { minDegree: 301, maxDegree: 330, value: 'L' },
  { minDegree: 271, maxDegree: 300, value: 'Voucher 1' },
  { minDegree: 241, maxDegree: 270, value: 'Air Pod' },
  { minDegree: 211, maxDegree: 240, value: 'Voucher 2' },
  { minDegree: 181, maxDegree: 210, value: 'L' },
  { minDegree: 151, maxDegree: 180, value: 'Voucher 3' },
  { minDegree: 121, maxDegree: 150, value: 'L' },
  { minDegree: 91, maxDegree: 120, value: 'Voucher 4' },
];

// voucher 1 5
// voucher 2 12
// voucher 3 2
// voucher 4 7


/* --------------- Size Of Each Piece  --------------------- */
const size = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
/* --------------- Background Colors  --------------------- */
var spinColors = [
  "#E74C3C",
  "#7D3C98",
  "#2E86C1",
  "#138D75",
  "#F1C40F",
  "#D35400",
  "#138D75",
  "#F1C40F",
  "#b163da",
  "#E74C3C",
  "#7D3C98",
  "#138D75",
];
/* --------------- Chart --------------------- */
/* --------------- Guide : https://chartjs-plugin-datalabels.netlify.app/guide/getting-started.html --------------------- */

//labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
let spinChart = new Chart(spinWheel, {
  plugins: [ChartDataLabels],
  type: "pie",
  data: {
    labels: ['Loose', 'Voucher 2', 'Voucher 4','Air Pod','Loose','Voucher 1','Air Pod','Voucher 2','Loose','Voucher 3','Loose','Voucher 4'],
    datasets: [
      {
        backgroundColor: spinColors,
        data: size,
      },
    ],
  },
  options: {
    responsive: true,
    animation: { duration: 0 },
    plugins: {
      tooltip: false,
      legend: {
        display: false,
      },
      datalabels: {
        rotation: 90,
        color: "#ffffff",
        formatter: (_, context) => context.chart.data.labels[context.dataIndex],
        font: { size: 15 },
        anchor: 'end',
        align: 'end',
        offset: -85,
      },
    },
  },
});
/* --------------- Display Value Based On The Angle --------------------- */
const generateValue = (angleValue) => {
  for (let i of spinValues) {
    if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
	  
	  te=i.value;
	  if(te=='L')
	  {
	   text.innerHTML = `<p>Sorry No Luck ! </p>`;	  
	  }
	  else
	  {
       text.innerHTML = `<p>Congratulations, You Have Won ${i.value} ! </p>`;
      }
      
      spinBtn.disabled = false;
      spinBtn.disabled = true;
      
      te=i.value;   // working
      
      //alert(te);    // working
      randomDegree = document.fn.randomDegree.value ;
      //alert(randomDegree);
      document.fn.spinitem.value=te ;
      
      te_count_air_pod   = document.fn.count_air_pod.value*1;
      //alert(te_count_air_pod)
      te_count_voucher_1 = document.fn.count_voucher_1.value*1;
      te_count_voucher_2 = document.fn.count_voucher_2.value*1;
      te_count_voucher_3 = document.fn.count_voucher_3.value*1;
      te_count_voucher_4 = document.fn.count_voucher_4.value*1;
      te_rem='';
      
      if(te=='Air Pod' && te_count_air_pod>=3)
      {
	   te='L';
	   te_rem='Air Pod Gifts Limit Exceeds in this Hour';
      }
      
   
      if(te=='Air Pod')
      {
	   te='L';
      }
   
      
      if(te=='Voucher 1' && te_count_voucher_1>=5)
      {
	   te='L';
	   te_rem='Voucher 1 Gifts Limit Exceeds in this Hour';
      }
      if(te=='Voucher 2' && te_count_voucher_2>=12)
      {
	   te='L';
	   te_rem='Voucher 2 Gifts Limit Exceeds in this Hour';
      }
      if(te=='Voucher 3' && te_count_voucher_3>=2)
      {
	   te='L';
	   te_rem='Voucher 3 Gifts Limit Exceeds in this Hour';
      }
      if(te=='Voucher 4' && te_count_voucher_4>=7)
      {
	   te='L';
	   te_rem='Voucher 4 Gifts Limit Exceeds in this Hour';
      }
      
      if(te_rem!='')
      {
	   alert(te_rem);   
      }
      document.fn.spinitem.value=te ;
      document.fn.spinrem.value=te_rem;
      
     
      
      if(te=='L')
      {
	   alert('Sorry No Luck !!!!!')   
      }
      else
      {
       alert('You have won '+te)
      }
      save_spin();
      
      //setTimeout(5000);
      alert('Try With Another Phone Number !!!!!!')
      var url = 'index.php';
      window.location.href = url;

      break;
    }
  }
  
  
};
/* --------------- Spinning Code --------------------- */
let count = 0;
let resultValue = 101;




/*
te_count_air_pod = document.getElementById('count_air_pod').value;
let te_count_air_pod   = document.fn.count_air_pod.value;

let te_count_voucher_1 = document.fn.count_voucher_1.value;
let te_count_voucher_2 = document.fn.count_voucher_2.value;
let te_count_voucher_3 = document.fn.count_voucher_3.value;
let te_count_voucher_4 = document.fn.count_voucher_4.value;
*/

//alert(te_count_air_pod);
  
spinBtn.addEventListener("click", () => {
  spinBtn.disabled = true;
  text.innerHTML = `<p>Best Of Luck!</p>`;
  let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);

  
  document.fn.randomDegree.value = randomDegree;
 
  
  let rotationInterval = window.setInterval(() => {
    spinChart.options.rotation = spinChart.options.rotation + resultValue;
    spinChart.update();
    if (spinChart.options.rotation >= 360) {
      count += 1;
      resultValue -= 5;
      spinChart.options.rotation = 0;
    } else if (count > 15 && spinChart.options.rotation == randomDegree) {
      generateValue(randomDegree);
      clearInterval(rotationInterval);
      count = 0;
      resultValue = 101;
    }
  }, 10);
});
/* --------------- End Spin Wheel  --------------------- */