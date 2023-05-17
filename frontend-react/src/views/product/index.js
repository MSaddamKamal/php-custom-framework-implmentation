import { useEffect, useState } from 'react';
import { ProductItem } from '../../components/Product';
import { Success } from '../../components/Utils/Alert';
import { useNavigate } from "react-router-dom";
import { baseUrl } from '../../config';



function ProductList() {

  const [products, setProducts] = useState([])
  const[successMsg, setSuccessMsg] = useState('')
  const navigate = useNavigate();

  useEffect(() => {
    getProducts()
  }, [])

  const getProducts = async () => {
    let res = await fetch(baseUrl+'get',{referrerPolicy: "unsafe-url" })
    let data = await res.json()
    data = data.data.map((item) => {
      return { ...item, checked: false }
    })
    setProducts(data)
  }

  const handleCheckBox = (e) => {
    let id = e.target.value
    let modifiedData = products.map((item => item.id == id ? { ...item, checked: !item.checked } : item))
    setProducts(modifiedData)
  }

  const massDelete = async () => {
    let ids = []
    for (let product of products) {
      if (product.checked) {
        ids.push(product.id)
      }
    }
    let res = await fetch(baseUrl+'deleteAll', {
      method: 'post',
      referrerPolicy: "unsafe-url" ,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ ids })
    })

    let data = await res.json()

    setSuccessMsg(data.message)
    setProducts(data?.data)

    setTimeout(()=>setSuccessMsg(''),2000)

  }


  return (
    <>
      <nav className="navbar navbar-light bg-light m-4">
        <span className="navbar-brand" >Scandiweb</span>
        <ul className="actions justify-content-end my-0">

          <button className="btn btn-warning ml-3 mb-1 text-white" onClick={massDelete}>MASS DELETE</button>
          <button className="btn btn-success ml-3 mb-1" onClick={() => navigate("product/new")}>ADD</button>
        </ul>
      </nav>
      <section className="products m-4">
        <div className="container">
         
          <Success successMsg={successMsg} />
        
          <div className="row">
            {
              products.length > 0 && products.map((item, idx) => {
                let attr = ''
                switch (item.productType) {
                  case 'DVD':
                    attr = `Size: ${item.size} MB`
                    break
                  case 'Book':
                    attr = `Weight: ${item.weight} KG`
                    break
                  case 'Furniture':
                    attr = `Dimensions: ${item.height}x${item.width}x${item.length}`
                    break
                  default:
                    attr = 'N/A'
                }
                return (
                  <ProductItem id={item.id} key={item.id} sku={item.sku} name={item.name} price={item.price}  attr={attr}  handleCheckBox={handleCheckBox} />
                )

              })
            }


          </div>
        </div>
      </section>
    </>
  );
}

export default ProductList;
