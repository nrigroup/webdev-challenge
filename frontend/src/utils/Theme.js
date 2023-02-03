class Theme {
  constructor() {
  }

  DetectWindowTheme() {
    const isCurrentDarkTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

    if (isCurrentDarkTheme) {
       this.ChangeWindowTheme("dark");
    }
    return isCurrentDarkTheme ? "dark" : "light";
  }

  ChangeWindowTheme(requestedTheme) {
      document.documentElement.setAttribute("data-theme", requestedTheme);
  }
}

export default Theme;