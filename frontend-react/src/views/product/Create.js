import { useState } from "react"
import { useNavigate } from "react-router-dom";
import { Error } from "../../components/Utils/Alert";
import { baseUrl } from '../../config';

const ProductAddForm = () => {
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        sku:'',
        name:'',
        price:'',
        productType:'',
        size:'',
        weight:'',
        height:'',
        width:'',
        length:'',

    })
    const [error,setError] = useState([])


    const handleInputChange = (e,name) =>
    {
        setFormData({...formData,[name]: e.target.value})
    }

    const onSubmit = async ()=>{
       
        let res = await fetch(baseUrl+'add', {
          method: 'post',
          referrerPolicy: "unsafe-url" ,
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ ...formData })
        })
    
        let data = await res.json()

        if(!data.error){
            navigate('/')
        }else{
            setError(Object.values(data.data))
            setTimeout(() => {
                setError([])
            }, 5000);
        }
    
    }

    return (
        <>
           {
            error.map((item,idx)=>{
                return (
                    <Error key={idx} msg={item} />
                )

            })
           }
            <div className="form-body">
                <div className="row" style={{justifyContent:"center"}}>
                    <div className="form-holder">
                        <div className="form-content">
                            <div className="form-items">
                                <div id="alert"></div>

                                <h3 className="text-center mb-5">Add New Product</h3>
                                <form id="product_form" onSubmit={onSubmit}>
                                    <div className="col-md-12">
                                        <input className="form-control" onChange={e=>handleInputChange(e,'sku')} value={formData.sku}  type="text" name="sku" id="sku" placeholder="SKU" />
                                    </div>

                                    <div className="col-md-12">
                                        <input className="form-control mt-3" onChange={e=>handleInputChange(e,'name')} value={formData.name} type="text" name="name" id="name"
                                            placeholder="Product Name" />
                                    </div>

                                    <div className="col-md-12">
                                        <input className="form-control mt-3" type="number" onChange={e=>handleInputChange(e,'price')} value={formData.price} name="price" id="price"
                                            placeholder="Price ($)" />
                                    </div>

                                    <div className="col-md-12">
                                        <select className="form-select m-0 mt-3" onChange={e=>handleInputChange(e,'productType')} value={formData.productType} id="productType">
                                            <option value="" defaultValue>Type Switcher</option>
                                            <option value="DVD" id="DVD">DVD</option>
                                            <option value="Book" id="Book">Book</option>
                                            <option value="Furniture" id="Furniture">Furniture</option>
                                        </select>
                                    </div>

                                    <div className="col-md-12">
                                        {formData.productType == 'DVD' && (
                                            <div className="dvd  py-3" id="dvd-inputs">
                                                <input className="form-control" type="number" onChange={e => handleInputChange(e, 'size')} value={formData.size} id="size" name="dvd"
                                                    placeholder="Size (MB)" />
                                                <small className="my-2 text-white">
                                                    Please provide DVD size in mega bytes
                                                </small>
                                            </div>
                                        )}

                                        {formData.productType == 'Book' && (
                                            <div className="book  py-3" id="book-inputs">
                                                <input className="form-control" type="number" onChange={e => handleInputChange(e, 'weight')} value={formData.weight} id="weight" name="book"
                                                    placeholder="Weight (KG)" />
                                                <small className="my-2 text-white">
                                                    Please provide book weight in kilo grams
                                                </small>
                                            </div>
                                        )}
                                        {formData.productType == 'Furniture' && (
                                            <div className="furniture  py-3" id="furniture-inputs">
                                                <input className="form-control mt-1" type="number" onChange={e => handleInputChange(e, 'height')} value={formData.height} id="height" name="dimension_h"
                                                    placeholder="Dimension (H)" />
                                                <input className="form-control mt-1" type="number" id="width" onChange={e => handleInputChange(e, 'width')} value={formData.width} name="dimension_w"
                                                    placeholder="Dimension (W)" />
                                                <input className="form-control mt-1" type="number" id="length" onChange={e => handleInputChange(e, 'length')} value={formData.length} name="dimension_L"
                                                    placeholder="Dimension (L)" />

                                                <small className="my-2 text-white">
                                                    Please provide dimensions in HxWxL format
                                                </small>
                                            </div>
                                        )}
                                       
                                       
                                  
                                                </div>

                                                <div className="form-button mt-3 d-flex justify-content-center">
                                                        <button type="button" className="btn btn-danger ml-3 " onClick={() => navigate("/")}>Cancel</button>
                                                        <button id="add-product" type="button" className="btn btn-success ml-2" onClick={onSubmit}>Save</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                
                </>
                )
}

export default ProductAddForm