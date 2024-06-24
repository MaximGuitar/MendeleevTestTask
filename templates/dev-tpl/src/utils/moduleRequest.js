import ky from 'ky';

/**
 * 
 * @param {string} module название модуля
 * @param {string} action ajax действие
 * @param {import('ky').Options} params параметры запроса
 * @returns {object} результат запроса
 */
const moduleRequest = async (module, action, params = {}) => {
    const query = {
        action: `${module}.${action}`,
        sessid: window.sessid
    };

    const result = await ky(`/bitrix/services/main/ajax.php?${new URLSearchParams(query).toString()}`, params).json()
    if (result.status == "error") {
        throw new Error("Ошибка")
    }
    return result
}
export default moduleRequest