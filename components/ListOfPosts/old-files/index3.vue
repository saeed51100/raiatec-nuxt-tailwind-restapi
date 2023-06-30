import { useState, useEffect } from 'vue'
import axios from 'axios'

export default {
setup () {
const [posts, setPosts] = useState([])
const [categories, setCategories] = useState([])

useEffect(() => {
axios.get('https://example.com/wp-json/wp/v2/posts')
.then(response => {
setPosts(response.data)
})
.catch(error => {
console.error(error)
})

axios.get('https://example.com/wp-json/wp/v2/categories')
.then(response => {
setCategories(response.data)
})
.catch(error => {
console.error(error)
})
}, [])

return {
posts,
categories
}
}
}