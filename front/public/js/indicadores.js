
function localDataSource(options) {
    var id = options.schema.model.id;
    var data = options.data;
    var newId = -1;
    var created, updated, deleted;
  
    var dataSource = new kendo.data.DataSource($.extend(true, {
      transport: {
        read: function(e) {
          created = {};
          updated = {};
          deleted = {};
  
          e.success(data || []);
        },
  
        update: function(e) {
          var item = e.data;
          if (!created[item[id]]) {
            updated[item[id]] = item;
          }
          e.success();
        },
  
        destroy: function(e) {
          var idValue = e.data[id];
          if (!created[idValue]) {
            deleted[idValue] = e.data;
          } else {
            delete created[idValue];
          }
          e.success();
        },
        create: function(e) {
          var item = e.data;
          item[id] = newId--;
          created[item[id]] = $.extend(true, {}, item);
  
          e.success(item);
        }
      },
    }, options));
  
    dataSource.getChanges = function() {
      return {
        deleted: toArray(deleted),
        created: toArray(created),
        updated: toArray(updated)
      }
    };
  
    return dataSource;
  }
  
  function toArray(changes) {
    var result = [];
    for (var id in changes) {
      result.push(changes[id]);
    }
    return result;
  }
  
  function createDiagram(indicadores, relaciones) {
    var arrayInd=[];
    for(var i=0; i < Object.keys(indicadores).length; i++) {
      var indicador = indicadores[i];
      arrayInd.push({"Id":indicador.id,"Indicador": indicador.nombre,"Color":indicador.color});
    }
    var shapesDataSource = localDataSource({
      data:arrayInd,
      schema: {
        model: {
          id: "Id",
          fields: {
            Id: {
              type: "number",
              editable: false
            },
            Indicador: {
              type: "string"
            },
            Color: {
              type: "string"
            }
          }
        }
      }
    });
  var arrayRel=[];
    for(var i=0; i < Object.keys(relaciones).length; i++) {
      var relacion = relaciones[i];
      arrayRel.push({"FromShapeId":relacion.predecesor_id,"ToShapeId":relacion.sucesor_id});
    }
    var connectionsDataSource = localDataSource({
      data: arrayRel,
      schema: {
        model: {
          id: "Id",
          fields: {
            Id: {
              type: "number",
              editable: false
            },
            from: {
              from: "FromShapeId",
              type: "number"
            },
            to: {
              from: "ToShapeId",
              type: "number"
            }
          }
        }
      }
     
    });
  
    var changesViewModel = kendo.observable({
      showChanges: function() {
        var diagram = $("#diagram").data("kendoDiagram");
        this.set("shapes", diagram.dataSource.getChanges());
        this.set("connections", diagram.connectionsDataSource.getChanges());
        this.set("visible", true);
      },
      shapes: {
        deleted: [],
        created: [],
        updated: []
      },
      connections: {
        deleted: [],
        created: [],
        updated: []
      }
    });
  
    kendo.bind($("#changes"), changesViewModel);
  
    $("#diagram").kendoDiagram({
      dataSource: shapesDataSource,
      connectionsDataSource: connectionsDataSource,
      layout: {
        type: "tree",
        subtype: "tipover",
        underneathHorizontalOffset: 140
        
        
      },
      shapeDefaults: {
        visual: visualTemplate,
        content: {
          template: "#= dataItem.Indicador #",
          fontSize: 17
        }
      },
      connectionDefaults: {
        stroke: {
          color: "#586477",
          width: 2
        }
      },
      dataBound: onDataBound
    });
  }
  
  $(document).ready(function(){
    cargarMapa();
  });  

  function visualTemplate(options) {
    var dataviz = kendo.dataviz;
    var g = new dataviz.diagram.Group();
    var dataItem = options.dataItem;
  
    if (dataItem.Indicador === "Indicador") {
      g.append(new dataviz.diagram.Circle({
        radius: 60,
        stroke: {
          width: 2,
          color: dataItem.Color || "#586477"
        },
        fill: "#e8eff7"
      }));
    } else {
      g.append(new dataviz.diagram.Rectangle({
        width: 240,
        height: 67,
        stroke: {
          width: 0
        },
        fill: "#e8eff7"
      }));
  
      g.append(new dataviz.diagram.Rectangle({
        width: 8,
        height: 67,
        fill: dataItem.Color,
        stroke: {
          width: 0
        }
      }));
    }
  
    return g;
  }
  
  function onDataBound(e) {
    this.bringIntoView(this.shapes);
  }