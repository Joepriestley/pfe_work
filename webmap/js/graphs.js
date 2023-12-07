


function distributionChart(chartCanvas, data, title){
    // reinitialize canvas chart if it already exists

    // if chartCanvas is ObjecHTMLCanvasElement, then change it to html  canvas element
    if (typeof chartCanvas === 'object'){
        chartCanvas = chartCanvas.getContext('2d');
    }
    var labels = [...data.labels].map(function(text) { return limitedText(text, 15)})
    return new Chart(chartCanvas, {
        type: 'bar',
        data: {
        labels: labels,
        datasets: [{
            label: title,
            data: data.values,
            borderWidth: 1
        }]
        },
        options: {      
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                beginAtZero: true
                }
            }
        }
    });


}


function barChart(canvasEl, data, title, axisTitles) {
    // if chartCanvas is ObjecHTMLCanvasElement, then change it to html  canvas element
    if (typeof canvasEl === 'object'){
        canvasEl = canvasEl.getContext('2d');
    }
    const chartData = {
        labels: data.labels,
        datasets: [{
          label: title,
          data: data.values
     }]
    };

    return  new Chart(canvasEl, {
        type: 'bar',
        data: chartData,
        options: {      
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title:{
                        display: axisTitles?.x ? true : false,
                        text: axisTitles?.x ?? ''
                    }
                },
                y: {
                    beginAtZero: true,
                    title:{
                        display: axisTitles?.y ? true : false, 
                        text: axisTitles?.y ?? ''
                    }
                }
            }
        }
    })
}


function doughnutChart(canvasEl, data, title) {
    // if chartCanvas is ObjecHTMLCanvasElement, then change it to html  canvas element
    if (typeof canvasEl === 'object'){
        canvasEl = canvasEl.getContext('2d');
    }
    const chartData = {
        labels: data.labels,
        datasets: [{
          label: title,
          data: data.values
     }]
      };

    return  new Chart(canvasEl, {
        type: 'doughnut',
        data: chartData,
        options: {      
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: false,
                },
                y: {
                    display: false,
                    beginAtZero: true
                }
            }
        }
    })
}




function limitedText(text, maxChars){
    return String(text).slice(0, maxChars) + (String(text).length > maxChars ? "..." : "")
}
