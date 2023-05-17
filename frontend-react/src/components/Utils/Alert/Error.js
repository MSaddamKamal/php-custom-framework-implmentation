

const Error = ({msg})=>{
    return (
        <>
         {msg != '' && (
            <div className='row ml-3 mr-3 '>
            <div className='col-12'>
              <div className="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> {msg}.
              </div>
            </div>
          </div>
          )}
        </>
    )
}

export default Error