import ApplicantNavs from "@/modules/Applicant/_navs"
import ClientNavs from "@/modules/Client/_navs"
import JobNavs from "@/modules/Job/_navs"
import SellableNavs from "@/modules/Sellable/_navs"
import InvoiceNavs from "@/modules/Invoice/_navs"
import ContractNavs from "@/modules/Contract/_navs"
import PaymentNavs from "@/modules/Payment/_navs"
import TemplateNavs from "@/modules/Template/_navs"
import CreditNoteNavs from "@/modules/CreditNote/_navs"
import CmsNavs from "@/modules/Cms/_navs"

export default [
    {
        _name: 'CSidebarNav',
        _children: [
            {
                _name: 'CSidebarNavItem',
                name: 'Dashboard',
                to: '/dashboard',
                icon: 'cil-speedometer',
                badge: {
                    color: 'primary',
                    text: 'NEW'
                }
            },
            ...ApplicantNavs,
            ...ClientNavs,
            ...JobNavs,
            ...SellableNavs,
            ...InvoiceNavs,
            ...ContractNavs,
            ...PaymentNavs,
            ...TemplateNavs,
            ...CreditNoteNavs,
            ...CmsNavs,
            {
                _name: 'CSidebarNavItem',
                name: 'Documentation',
                to: '/documentation',
                icon: {name: 'cil-book', class: 'text-white'},
                _class: 'bg-success text-white',
            },
        ]
    }
]
