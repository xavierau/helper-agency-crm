/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    pages: '/api/cms/pages',
    get_page_content: page_id => `/api/cms/pages/${page_id}/contents`,
    update_page_content: (page_id, key) => `/api/cms/pages/${page_id}/contents/${key}`,
    common_contents: '/api/cms/common_contents',
    common_content: key => `/api/cms/common_contents/${key}`,
    update_common_content: key => `/api/cms/common_contents/${key}`,
    list_news: '/api/cms/news',
    create_news: '/api/cms/news',
    get_news: id=>`/api/cms/news/${id}`,

}


export default endpoints
