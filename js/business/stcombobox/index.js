var StcBox = { 
    int : function(data,obj){ 
       // CreateCollegesCombo(); 
       StcBox.CreateStatesCombo(data,obj);
    }, 
    CreateStatesCombo:function(datas,obj) {
        var combo = new STComboBox(); 
        combo.Init('statesCombo',obj);
        var data = []; 
        var states = datas; 
        // console.log(states);
        for(var i=0; i < states.length; i++) { 
            data.push({id: i, text: states[i].va,texts:states[i].vb,vid:states[i].vid});
        } 
        //console.log(obj.url);
        combo.populateList(data,obj);
    }
};  