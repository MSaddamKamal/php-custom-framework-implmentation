

const Success = ({successMsg})=>{
    return (
        <>
         {successMsg != '' && (
            <div className='row'>
            <div className='col-12'>
              <div className="alert alert-success">
                <strong>Success!</strong> {successMsg}.
              </div>
            </div>
          </div>
          )}
        </>
    )
}

export default Success