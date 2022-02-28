<script src="http://docs.handsontable.com/0.16.1/scripts/jquery.min.js"></script>
<script src="http://docs.handsontable.com/0.16.1/bower_components/handsontable/dist/handsontable.full.js"></script>
<link type="text/css" rel="stylesheet" href="http://docs.handsontable.com/0.16.1/bower_components/handsontable/dist/handsontable.full.min.css">
<script>
document.addEventListener("DOMContentLoaded", function() {

  var
    container = document.getElementById('example1'),
    hot;
  
  hot = new Handsontable(container, {
    data: Handsontable.helper.createSpreadsheetData(200, 10),
    rowHeaders: true,
    colHeaders: true,
    colWidths: [55, 80, 80, 80, 80, 80, 80],
    rowHeights: [50, 40, 100],
    manualColumnResize: true,
    manualRowResize: true
  });
  
  function bindDumpButton() {
      if (typeof Handsontable === "undefined") {
        return;
      }
  
      Handsontable.Dom.addEvent(document.body, 'click', function (e) {
  
        var element = e.target || e.srcElement;
  
        if (element.nodeName == "BUTTON" && element.name == 'dump') {
          var name = element.getAttribute('data-dump');
          var instance = element.getAttribute('data-instance');
          var hot = window[instance];
          console.log('data of ' + name, hot.getData());
        }
      });
    }
  bindDumpButton();

});</script>

<div id="example1" class="hot handsontable htRowHeaders htColumnHeaders"></div>