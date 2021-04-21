import { inject } from '@vue/runtime-core'

export default function useToast() {
  const toast = inject('toast')
  const successToast = (message = 'Success!') => {
    toast.success(message)
  }

  const errorToast = (message = 'Something went wrong!') => {
    toast.error(message)
  }
  return { successToast, errorToast }
}
