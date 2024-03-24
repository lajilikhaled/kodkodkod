
$(document).ready(function(){
    var activeCat = "";
    function filterGroup(group){
        if(activeCat != group){
            $(".project").filter("."+group).show();
            $(".project").filter(":not(."+group+")").hide();
            activeCat = group;
        }
    }

    $(".cat-all").click(function(){
        $(".project").show();
        activeCat = "all";
        $(".filter-select").prop('selectedIndex', 0);
    });

    $(".filter-select").change(function(){
        var selectedGroup = $(this).val();
        filterGroup(selectedGroup);
        $(".filter-select").not(this).prop('selectedIndex', 0);
    });
});