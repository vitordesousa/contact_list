export const checkPhone = (value) => {

	console.log(value)
	return true
	/* if(value.length > 8){
		return axios.get(`/contacts/check-data/${value}/1`, { 
			data: value, 
		}).then((response) => { 
			if (response.status === 200) { 
				return true; 
			} return false; 
		}) .catch((e) => { 
			return false; 
		}); 
	} else {
		return false
	} */
}

export const checkEmail = (value) => {
	return true
	/* if(value.length > 10){
		return axios.get(`/contacts/check-data/${value}/2`, { 
			data: value, 
		}).then((response) => { 
			if (response.status === 200) { 
				return true; 
			} return false; 
		}) .catch((e) => { 
			return false; 
		}); 
	} else {
		return false
	} */
}