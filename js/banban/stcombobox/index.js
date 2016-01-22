
$(document).ready(function() {
    //CreateCollegesCombo();
    CreateStatesCombo();
});

// function CreateCollegesCombo() {
//     var combo = new STComboBox();
//     combo.Init('collegesCombo');
//     var data = [];

//     var colleges = GetColleges();

//     for(var i=0; i < colleges.length; i++) {
//         data.push({id: i, text: colleges[i]});
//     }
//     combo.populateList(data);
// }

function CreateStatesCombo() {
    var combo = new STComboBox();
    combo.Init('schoolname');
    var data = []; 
    var states = GetStates(); 
    for(var i=0; i < states.length; i++) {
        data.push({id: i, text: states[i]});
    }
    combo.populateList(data);
}

function GetStates() {
    
    return [
        {"name":"汉字","pinYin":"Alabama"},
         {"name":"汉字","pinYin":"Alaska"},
         {"name":"汉字","pinYin":"Arizona"},
         {"name":"汉字","pinYin":"Arkansas"},
         {"name":"汉字","pinYin":"California"},
         {"name":"汉字","pinYin":"Colorado"},
         {"name":"汉字","pinYin":"Connecticut"},
         {"name":"汉字","pinYin":"Delaware"},
         {"name":"汉字","pinYin":"Florida"},
         {"name":"汉字","pinYin":"Georgia"},
         {"name":"汉字","pinYin":"Hawaii"},
         {"name":"汉字","pinYin":"Idaho"},
         {"name":"汉字","pinYin":"Illinois"},
         {"name":"汉字","pinYin":"Indiana"},
         {"name":"汉字","pinYin":"Iowa"},
         {"name":"汉字","pinYin":"Kansas"},
         {"name":"汉字","pinYin":"Kentucky"},
         {"name":"汉字","pinYin":"Louisiana"},
         {"name":"汉字","pinYin":"Maine"},
         {"name":"汉字","pinYin":"Maryland"},
         {"name":"汉字","pinYin":"Massachusetts"},
         {"name":"汉字","pinYin":"Michigan"},
         {"name":"汉字","pinYin":"Minnesota"},
         {"name":"汉字","pinYin":"Mississippi"},
         {"name":"汉字","pinYin":"Missouri"},
         {"name":"汉字","pinYin":"Montana"},
         {"name":"汉字","pinYin":"Nebraska"},
         {"name":"汉字","pinYin":"Nevada"},
         {"name":"汉字","pinYin":"New Hampshire"},
         {"name":"汉字","pinYin":"New Jersey"},
         {"name":"汉字","pinYin":"New Mexico"},
         {"name":"汉字","pinYin":"New York"},
        {"name":"汉字","pinYin":"North Carolina"},
        {"name":"汉字","pinYin":"North Dakota"},
        {"name":"汉字","pinYin":"Ohio"},
        {"name":"汉字","pinYin":"Oklahoma"},
        {"name":"汉字","pinYin":"Oregon"},
        {"name":"汉字","pinYin":"Pennsylvania"},
        {"name":"汉字","pinYin":"Rhode Island"},
        {"name":"汉字","pinYin":"South Carolina"},
        {"name":"汉字","pinYin":"South Dakota"},
        {"name":"汉字","pinYin": "Tennessee"},
        {"name":"汉字","pinYin":"Texas"},
        {"name":"汉字","pinYin":"Utah"},
        {"name":"汉字","pinYin":"Vermont"},
        {"name":"汉字","pinYin":"Virginia"},
        {"name":"汉字","pinYin":"Washington"},
        {"name":"汉字","pinYin":"West Virginia"},
        {"name":"汉字","pinYin":"Wisconsin"},
        {"name":"汉字","pinYin":"Wyoming"}
    ];
} 