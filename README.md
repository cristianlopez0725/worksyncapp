[README_colaboradores.md](https://github.com/user-attachments/files/19858378/README_colaboradores.md)# 🛠️ Instrucciones para colaboradores del proyecto WorkSyncApp

¡Bienvenidos al repositorio oficial del proyecto!  
Cada miembro del equipo tiene su propia rama asignada para trabajar de forma ordenada y evitar conflictos.

---

## 📌 Ramas asignadas

| Colaborador   | Rama asignada |
|---------------|----------------|
| Hernando      | `hernandoZ`    |
| Camilo        | `camilo`       |
| Mateo M       | `mateoM`       |
| Clara         | `clara`        |
| Mateo Z       | `mateoZ`       |
| Líder (Cristian) | `main` (gestión general) |

---

## 🚀 ¿Cómo empezar?

### 1. Clonar el repositorio

Abre tu terminal o Git Bash y ejecuta:

```bash
git clone https://github.com/cristianlopez0725/worksyncapp.git
cd worksyncapp
```

### 2. Cambiarte a tu rama

Reemplaza `tu-rama` por la que te corresponde (ver tabla de arriba):

```bash
git checkout tu-rama
```

---

## 💻 Flujo de trabajo

1. Realiza tus cambios localmente.
2. Guarda y sube los cambios:

```bash
git add .
git commit -m "Descripción clara de los cambios"
git push origin tu-rama
```

3. Cuando termines una funcionalidad, avísale al líder para que revise tu rama y la fusione a `main` mediante un Pull Request.

---

## 🔄 Mantén tu rama actualizada (opcional pero recomendado)

Cada cierto tiempo puedes sincronizarte con `main` para tener los últimos cambios:

```bash
git checkout main
git pull origin main
git checkout tu-rama
git merge main
```

---

## ❗ Recomendaciones

- No trabajar directamente en `main`.
- No modificar ramas de otros compañeros.
- Escribe mensajes de commit claros y específicos.

---

¡Gracias por tu colaboración y buen trabajo en equipo!  
Cualquier duda, comunícate con el líder del proyecto.

