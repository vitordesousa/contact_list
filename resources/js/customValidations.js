export const checkPhone = (value) => {
	if(value.length > 8){
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
		return true
	}
}

export const checkEmail = (value) => {
	if(value.length > 6){
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
		return true
	}
}