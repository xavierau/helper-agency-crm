/**
 * Created by A & A Creation Co. on 26/8/2020.
 */


import _ from 'lodash'
import moment from 'moment'

export const capitalize = value => {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
}

export const sortBy = (value, key, is_asc = true) => {

    let result = _.sortBy(value, key)

    return is_asc ? result : _.reverse(result)
}

export const formatCurrency = (value) => {
    const formatter = new Intl.NumberFormat('zh-hk', {
        style: 'currency',
        currency: 'HKD'
    })

    return formatter.format(value); /* $2,500.00 */

}

export const formatDate = (value, format = "d/M/Y") => moment(value).format(format)
export const formatDatetime = (value, format = "d/M/Y h:mm a") => moment(value,).format(format)

export const join = value => value.join(', ')
