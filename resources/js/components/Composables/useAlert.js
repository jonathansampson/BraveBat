import swal from 'sweetalert'

export default function useAlert() {
  const deleteAlert = (callback) => {
    swal({
      title: 'Are you sure?',
      text: 'Once deleted, you will not be able to recover it!',
      icon: 'warning',
      buttons: true,
      dangerMode: true
    }).then((willDelete) => {
      if (willDelete) {
        callback()
      }
    })
  }
  return { deleteAlert }
}
