


const ProductItem = ({id,sku,name,price,attr,handleCheckBox})=>{
    return(
        <div className="col-md-3 col-sm-6" key={id}>
        <div className="card mt-4">
          <div className="card-body">
          <input type="checkbox" className="btn-check delete-checkbox"
            id={'btn-check-' + id}
            value={id}
            onChange={handleCheckBox}
          />

          <h5 className="sku font-weight-bold pt-3">{sku}</h5>
          <h5 className="name ">{name}
          </h5>
          <p className="price">{price}
          </p>
          <p className="type">
            {attr}
          </p>
          </div>

        </div>
      </div>
    )

}


export default ProductItem