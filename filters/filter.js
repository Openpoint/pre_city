lkcity.filter('getByProperty', function() {
    return function(collection, propertyName,propertyName2, propertyValue ) {
		if(collection && propertyValue!=null){
			var result=new Array();
			var i=0, len=collection.length;
			for (; i<len; i++) {
				if (collection[i][propertyName][propertyName2] == +propertyValue) {
					result.push(collection[i]);
				}
			}
			return result;
		}else{
			return collection;
		}
    }
});
lkcity.filter('status', function() {
    return function(x,y) {

		return x[y].value;
	}
});


//get the usage array key indexes for cascading select
lkcity.filter('getkeyindex', function() {
    return function(array,z,u,su) {
		var usage = false;
		var subusage = false;
		var refine = false;
		for(x in array){
			if(array[x].zid==z){
				usage=array[x].usage;
			}
		}
		if(typeof u != 'undefined'){
			
			for(x in usage){
				if(usage[x].usage==u){
					subusage=usage[x].subusage;
				}
			}			
		}else{
			return usage
		}
		if(typeof su != 'undefined'){
			
			for(x in subusage){
				if(subusage[x].subusage==su){
					refine=subusage[x].refine;
				}
			}
			return refine;			
		}else{
			return subusage
		}
		
	}
});
//filter out unused keys
lkcity.filter('checkkey', function() {
	
    return function(array,tzoning,z,u,su) {
		
		var usage = false;
		var subusage = false;
		var refine = false;
		for(x in array){
			if(array[x].zid==z){
				usage=array[x].usage;
			}
		}
		console.log(tzoning[z][u]);
		if(typeof u != 'undefined' && typeof tzoning[z][u]!='undefined'){
			
			for(x in usage){
				if(usage[x].usage==u){
					subusage=usage[x].subusage;
				}
			}			
		}else{
			return usage
		}
		console.log(tzoning[z][u][su]);
		if(typeof su != 'undefined' && typeof tzoning[z][u][su]!='undefined'){
			
			for(x in subusage){
				if(subusage[x].subusage==su){
					refine=subusage[x].refine;
				}
			}
			return refine;			
		}else{
			return subusage
		}
		
	}
});
//get the usage values by key
lkcity.filter('getkeyvalue', function() {
	
    return function(array,val,z,u,su,r) {

		var usage = false;
		var subusage = false;
		var refine = false;
		var value = false;
		for(x in array){
			if(array[x].zid==z){
				usage=array[x].usage;
				value=array[x][val];
			}
		}
		if(typeof u != 'undefined'){
			
			for(x in usage){
				if(usage[x].usage==u){
					subusage=usage[x].subusage;
					value=usage[x][val];
				}
			}			
		}else{
			return value;
		}
		if(typeof su != 'undefined'){
			
			for(x in subusage){
				if(subusage[x].subusage==su){
					refine=subusage[x].refine;
					value=subusage[x][val];
				}
			}			
		}else{
			return value
		}
		if(typeof r != 'undefined'){
			
			for(x in refine){
				if(refine[x].refine==r){
					value=refine[x][val];
				}
			}
			return value;			
		}else{
			return value;
		}
		
	}
});
//get the street by sid
lkcity.filter('street', function() {
    return function(array,sid) {
		var name=null;
		for(x in array){
			if(array[x].sid==sid){
				name=array[x].name
			}
		}
		return name;
	}
});
//get data area by zid
lkcity.filter('zonearea', function() {
    return function(array,zid) {
		var area=null;
		for(x in array){
			if(array[x].zid==zid){
				area=array[x].total
			}
		}
		//alert(area);
		return area;
	}
});
lkcity.filter('filterselect', function() {
    return function(array,zid,usage,subusage,refine) {
		var selection=new Array();
		for(x in array){
			if(array[x].zid==zid && usage==null){
				selection.push(array[x])
			}else if(array[x].zid==zid && array[x].usage==usage && subusage==null){
				selection.push(array[x])
			}else if(array[x].zid==zid && array[x].usage==usage && array[x].subusage==subusage && refine==null){
				selection.push(array[x])				
			}else if(array[x].zid==zid && array[x].usage==usage && array[x].subusage==subusage && array[x].refine==refine){
				selection.push(array[x])				
			}
		}
		return selection;
	}
});

//get the length of a object
lkcity.filter('olength', function() {
    return function(array) {
		var len=0;
		for(x in array){
			len++;
		}
		return len;
	}
});
//convert to percentage
lkcity.filter('percent', function() {
    return function(part,total) {
		return Math.ceil(part/total*100)+'%';
	}
});
//placeholder for unamed unit
lkcity.filter('unitname', function() {
    return function(name) {
		if(name == '*?*'){
			return 'UNAMED UNIT';
		}else{
			return name;
		}
	}
});
//placeholder for unamed address
lkcity.filter('address', function() {
    return function(name) {
		if(name == '*?*'){
			return 'No. ?';
		}else{
			return 'No. '+name;
		}
	}
});
//get the tenants on a level
lkcity.filter('thislevel', function() {
    return function(list,level,suffix) {		
		if(list.level==level){
			return list.tenant+suffix;
		}
	}
});
