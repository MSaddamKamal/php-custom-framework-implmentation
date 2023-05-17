import { Routes, Route } from "react-router-dom"

import ProductList from "./views/product"
import ProductAddForm from "./views/product/Create"

function App() {
  return (
    <div className="App">
      <Routes>
        <Route path="/" element={ <ProductList/> } />
        <Route path="product/new" element={ <ProductAddForm/> } />
        
      </Routes>
    </div>
  )
}

export default App