import preset from '../../../../vendor/filament/filament/tailwind.config.preset'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography' 


export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/views/infolists/components/*.blade.php',
    ],
    theme:{
        fontFamily: {
            dosis: ["Dosis", "sans-serif"],
          },
          container: {
            center: true,
            padding: {
              DEFAULT: '1rem',
              sm: '2rem',
              lg: '4rem',
              xl: '4rem',
              '2xl': '4rem',
            },
          },
          listStyleType: {
            none: "none",
            disc: "disc",
            decimal: "decimal",
            square: "square",
            roman: "upper-roman",
          },
          data: {
            open: 'ui~="open"',
            active: 'ui~="active"',
          },
        extend: {
            colors: {
                "tp-orange": "#E95A24",
                "tp-red": "#DE1C24",
                "tp-verdigris": "#3CB2B2",
                "tp-fountain-blue": "#55B1C6",
                "tp-midnight": "#001435",
                "tp-beeyellow": "#EEA913",
                "tp-school-bus-yellow": "#E5A013",
                "tp-orangey-yellow": "#FCB813",
                "tp-flirt": "#C7FF2E",
                "tp-pistachio-green": "#9AC002",
                "tp-cerulean": "#00ABD6",
                "tp-curious-blue": "#299DD4",
                "tp-storm-grey": "#828282",
                "tp-santa-grey": "#99A1AE",
                "tp-ghost": "#c7cbd3",
                "tp-gainsboro": "#d9dce1",
                "tp-harp": "#ebedef",
                "tp-aqua-island": "#9dd5d5",
                "tp-bee-yellow": "#EDA813",
                "es-coimbra": "#007C36",
                "es-algarve": "#1F3C86",
                "es-viana-do-castelo": "#A85F18",
                "es-vila-real-de-santo-antonio": "#4A519C",
                "es-setubal": "#E97D34",
                "es-porto": "#B6241A",
                "es-oeste": "#2AB6C4",
                "es-lisboa": "#00939C",
                "es-estoril": "#F9D024",
                "es-douro-lamego": "#801A16",
                "es-portalegre": "#F39C22",
                "es-portimao": "#2F5EA7",
            },
            gridTemplateColumns: {
                "2-max-w-max": "max-content 1fr",
            },
            borderRadius: {
                "1/4-rb": "0% 100% 100% 0% / 100% 0% 100% 0%",
                "1/4-lb": "0% 100% 0% 100% / 0% 0% 100% 100% ",
                "4xl": "2rem", // 32px
                "5xl": "2.5rem", // 40px
                "6xl": "3rem", // 48px
            },
            typography: (theme) => ({
                DEFAULT: {
                  css: {
                    color: theme("colors.black"),
                    maxWidth: "none",
                    a: {
                      color: theme("colors.tp-midnight"),
                      '&:hover': {
                        color: '#000',
                      },
                    },
                  },
                },
                lg: {
                  css: {
                    p: {
                      marginTop: "1rem",
                      marginBottom: "1rem",
                    },
                  },
                },
            }),
        }
    },
    plugins: [
        forms, 
        typography, 
    ],
    safelist: [
        {
          pattern: /bg-opacity-.+/,
          variants: ["before"],
        },
        {
          pattern: /(fill|bg|text)-es-.+/,
          variants: ["hover"],
        },
        {
          pattern: /(fill|bg|text)-tp-.+/,
          variants: ["hover", "before"],
        },
        {
          pattern: /(fill|bg)-(gray)-(200)/,
          variants: [],
        },
      ],
    
}
